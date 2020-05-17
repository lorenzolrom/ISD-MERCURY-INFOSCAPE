let issuesLoaded = false;

function getForm()
{
    let systemCode = document.getElementById('systemCode').value;
    let stamp = document.getElementById('stamp').value;
    let bitting = document.getElementById('bitting').value;
    let type = document.getElementById('type').value;
    let keyway = document.getElementById('keyway').value;
    let notes = document.getElementById('notes').value;

    return {
        systemCode: systemCode,
        stamp: stamp,
        bitting: bitting,
        type: type,
        keyway: keyway,
        notes: notes
    };
}

function search()
{
    apiRequest('POST', 'lockkeys/search', getForm()).done(function(json){

        if(json.code === 200)
        {
            let refs = [];
            let rows = [];

            $.each(json.data, function(i, v){
                refs.push(v.id);

                rows.push([
                    v.systemCode,
                    v.stamp,
                    v.bitting,
                    v.type,
                    v.keyway
                ]);
            });

            $('#results').mlTable({
                refs: refs,
                rows: rows,
                sortColumn: 0,
                sortMethod: 'asc',
                header: ['System', 'Stamp', 'Bitting', 'Type', 'Keyway'],
                linkColumn: 1,
                href: baseURI + 'cliff/keys/'
            });
        }

        setSearchCookie('cliffkeysearch', getForm());
        unveil();
    });

    return false;
}

function create(createAnother = false)
{
    apiRequest('POST', 'lockkeys', getForm()).done(function(json){
        if(json.code === 201)
        {
            if(createAnother) // Do not redirect
            {
                showNotifications('success', ['Key created']);
                unveil();
            }
            else
            {
                window.location.replace(baseURI + 'cliff/keys?SUCCESS=Key created');
            }
        }

    });

    if(!createAnother)
        return false;
}

function update(id)
{
    apiRequest('PUT', 'lockkeys/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'cliff/keys?SUCCESS=Key updated');
    });

    return false;
}

function del(id)
{
    apiRequest('DELETE', 'lockkeys/' + id, []).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'cliff/keys?SUCCESS=Key deleted');
    });
}

function loadIssues(id, override = false)
{
    let issueRegion = document.getElementById('issues-region');

    if(issuesLoaded && !override)
        return;

    apiRequest('GET', 'lockkeys/' + id + '/issues', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.serial,
                v.issuedTo
            ]);
        });

        $(issueRegion).mlTable({
            refs: refs,
            rows: rows,
            sortColumn: 0,
            sortMethod: 'asc',
            header: ['Serial', 'Issued To'],
            linkColumn: 0,
            href: "javascript: popupEditIssue('{{%}}')",
            usePlaceholder: true
        });

        issuesLoaded = true;
    });
}

function popupEditIssue(id)
{
    let editIssueSerial = document.getElementById('editIssueSerial');
    let editIssueIssuedTo = document.getElementById('editIssueIssuedTo');
    let delIssueButton = document.getElementById('delIssueButton');
    let editIssueForm = document.getElementById('editIssueForm');

    apiRequest('GET', 'lockkeys/' + keyId + '/issues/' + id, []).done(function(json){
        if(json.code !== 200)
            return;

        editIssueSerial.value = json.data.serial;
        editIssueIssuedTo.value = json.data.issuedTo;
        delIssueButton.onclick = function(){
            delIssue(json.data.id);
        };

        editIssueForm.onsubmit = function(){
          updateIssue(json.data.id);
          return false;
        };

        let dialog = document.getElementById('editIssue-dialog');
        $(dialog).dialog().dialog("option", {
            position: {
                my: 'top',
                at: 'right',
                of: event
            }
        });
    });
}

function createIssue(id)
{
    let serial = document.getElementById('issueKeySerial').value;
    let issuedTo = document.getElementById('issueKeyIssuedTo').value;

    apiRequest('POST', 'lockkeys/' + id + '/issues', {
        serial: serial,
        issuedTo: issuedTo
    }).done(function(json){
        if(json.code === 201)
        {
            showNotifications('success', ['Key issued']);

            if(issuesLoaded)
                loadIssues(id, true); // Force re-load of issues if already loaded
        }

        unveil();
    });

    return false;
}

function updateIssue(id)
{
    let issuedTo = document.getElementById('editIssueIssuedTo').value;

    apiRequest('PUT', 'lockkeys/' + keyId + '/issues/' + id, {
        issuedTo: issuedTo
    }).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Issue updated']);
            if(issuesLoaded)
                loadIssues(keyId, true);
        }
        unveil();
    });
}

function delIssue(id)
{
    apiRequest('DELETE', 'lockkeys/' + keyId + '/issues/' + id, []).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Issue deleted']);
            if(issuesLoaded)
                loadIssues(keyId, true);

            $('#editIssue-dialog').dialog('close');
        }

        unveil();
    });
}

/**
 * If a search cookie is set, re-run the search
 */
function restoreSearch()
{
    if(!document.getElementById("results"))
        return;

    let last =  getCookie('cliffkeysearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $('#stamp').val(last.stamp);
        $('#bitting').val(last.bitting);
        $('#systemCode').val(last.systemCode);
        $('#keyway').val(last.keyway);
        $('#type').val(last.type);
        $('#notes').val(last.notes);
        search();
    }
}

$(document).ready(function(){
    restoreSearch();
});

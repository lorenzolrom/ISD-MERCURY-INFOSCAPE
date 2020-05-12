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

function create()
{
    apiRequest('POST', 'lockkeys', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'cliff/keys?SUCCESS=Key created');
    });

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
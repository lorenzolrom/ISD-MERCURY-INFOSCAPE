let updatesLoaded = false;
let assigneesLoaded = false;
let assigneesSelectLoaded = false;
let historyLoaded = false;

function getTicketForm()
{
    let title = $('#title').val();
    let contact = $('#contact').val();
    let severity = $('#severity').val();
    let type = $('#type').val();
    let category = $('#category').val();
    let status = $('#status').val();
    let closureCode = $('#closureCode').val();
    let desiredDate = $('#desiredDate').val();
    let scheduledDate = $('#scheduledDate').val();
    let assignees = $('#assignees').val();

    tinyMCE.triggerSave();
    let description = $('#editor').val();

    return {
        title: title,
        contact: contact,
        severity: severity,
        type: type,
        category: category,
        status: status,
        closureCode: closureCode,
        desiredDate: desiredDate,
        scheduledDate: scheduledDate,
        description: description,
        assignees: assignees
    };
}

function selectWorkspace()
{
    let workspace = $('#workspace').val();
    return changeWorkspace(workspace);
}

function changeWorkspace(workspace)
{
    veil();
    apiRequest('GET', 'tickets/workspaces/' + workspace, {}).done(function(json){
        if(json.code !== 200)
            showNotifications('error', ['Workspace is not valid']);
        else
        {
            setCookie('agentWorkspace', workspace);
            $('#workspace').prop('disabled', true);
            window.location.reload();
        }

        unveil();
    });

    return false;
}

function getWorkspace()
{
    return getCookie('agentWorkspace');
}

function showTickets(tickets)
{
    let rows = [];
    let refs = [];

    $.each(tickets, function(i, v){
        refs.push(v.number);

        rows.push([
            v.number,
            v.title,
            v.type,
            v.category,
            v.severity,
            v.status,
            v.scheduledDate,
            v.lastUpdate
        ]);
    });

    setupTable({
        target: 'tickets',
        header: ['#', 'Title', 'Type', 'Category', 'Severity', 'Status', 'Scheduled', 'Updated'],
        sortColumn: 0, // TODO: add last update time and sort by that
        linkColumn: 0,
        linkNewTab: true,
        href: baseURI + 'tickets/agent/',
        refs: refs,
        rows: rows
    });
}

function quickSearch()
{
    let query = $('#search').val();
    applyLoadingImage('tickets');

    $('#filter').val('currentSearch');

    apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/tickets/quickSearch', {query: query}).done(function(json){
        showTickets(json.data);
    });

    return false;
}

function updateFilter()
{
    let filter = $('#filter').val();

    if(filter === 'currentSearch')
        return;

    applyLoadingImage('tickets');

    if(filter === 'myAssignments')
    {
        apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/myAssignments', {}).done(function(json){
            showTickets(json.data);
        });
    }
    else if(filter === 'open')
    {
        apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/open', {}).done(function(json){
            showTickets(json.data);
        });
    }
    else if(filter === 'closed')
    {
        apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/closed', {}).done(function(json){
            showTickets(json.data);
        });
    }
}

function loadWidgets()
{

}

function updateEditForm()
{
    let status = $('#status').val();

    if(status !== 'clo')
        $('.closureCode').hide();
    else
        $('.closureCode').show();
}

function create()
{
    apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/tickets', getTicketForm()).done(function(json){
        if(json.code === 201)
        {
            window.location.replace(baseURI + 'tickets/agent/' + json.data.number);
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function update(number)
{
    apiRequest('PUT', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number, getTicketForm()).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + 'tickets/agent/' + number);
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function loadUpdates(number)
{
    if(updatesLoaded)
        return;

    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/updates', {}).done(function(json){
        let rows = [];

        $.each(json.data, function(i,v){
            rows.push([
                v.time,
                v.name + ' (' + v.user + ')',
                v.description
            ]);
        });

        setupTable({
            target: 'update-region',
            header: ['Time', 'User', 'Description'],
            sortColumn: 0,
            rows: rows,
            rawText: true
        });
    });

    updatesLoaded = true;
}

function loadAssignees(number, override = false)
{
    if(assigneesLoaded && !override)
        return;

    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/assignees', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){

            if(v.users.length === 0)
            {
                rows.push([v.name, 'REMOVE']);
                refs.push(v.id);
            }
            else
            {
                $.each(v.users, function(j,w){
                    rows.push([v.name + ' - ' + w.name + ' (' + w.username + ')', 'REMOVE']);
                    refs.push(v.id + '-' + w.id);
                });
            }
        });

        setupTable({
            target: 'assignee-region',
            header: ['Assignee', ''],
            href: "javascript: removeAssignee('" + number + "', '{{%}}')",
            usePlaceholder: true,
            linkColumn: 1,
            rows: rows,
            refs: refs
        });
    });

    assigneesLoaded = true;
}

function loadHistory(number, override = false)
{
    if(historyLoaded && !override)
        return;

    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/history', {}).done(function(json){
        let rows = [];

        $.each(json.data, function(i,v){
            let changes = "";

            $.each(v.changes, function(j,w){
                changes += w + "<br/>";
            });

            rows.push([
                v.time,
                v.user,
                changes
            ]);
        });

        setupTable({
            target: 'history-region',
            header: ['Time', 'User', 'Changes'],
            sortColumn: 0,
            rows: rows,
            rawText: true
        });
    });

    historyLoaded = true;
}

function loadAssigneeSelect()
{
    if(assigneesSelectLoaded)
        return;

    let select = document.getElementById('assigneeSelect'); // This is the multiple select element

    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/assignees', {}).done(function(json){
        // Structure of json is:
        // array of teams, each with 'id' and 'name' and 'users'
        // 'users' is an array of users with 'id', 'name', 'username'

        // Create select with options of class 'team' if a team, and 'user' if a user

        $.each(json.data, function(i, v){

            // Create team option
            let teamOption = document.createElement('option');
            teamOption.classList.add('team');
            teamOption.setAttribute('value', v.id);

            let teamName = document.createTextNode(v.name);
            teamOption.appendChild(teamName);

            select.appendChild(teamOption);

            $.each(v.users, function(j,w){
                let userOption = document.createElement('option');
                userOption.classList.add('user');
                userOption.setAttribute('value', v.id + '-' + w.id);

                let userName = document.createTextNode(w.name + ' (' + w.username + ')');
                userOption.appendChild(userName);

                select.appendChild(userOption);
            });
        });
    });

    assigneesSelectLoaded = true;
}

function assignTicket(number)
{
    let assignees = $('#assigneeSelect').val();
    let overwrite = $('#overwriteAssignees').prop("checked");

    apiRequest('PUT', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/assignees', {assignees: assignees, overwrite: overwrite}).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Ticket assigned']);

            if(assigneesLoaded)
                loadAssignees(number, true);

            if(historyLoaded)
                loadHistory(number, true);
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function removeAssignee(number, code)
{
    apiRequest('DELETE', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/assignee', {assignee: code}).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Assignee removed']);

            if(assigneesLoaded)
                loadAssignees(number, true);

            if(historyLoaded)
                loadHistory(number, true);
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });
}

$(document).ready(function(){

    if($('#filter').length !== 0)
    {
        updateFilter();
    }

    if($('#widgets').length !== 0)
    {
        loadWidgets();
    }

    if($('#ticket-form').length !== 0)
    {
        updateEditForm();
    }

    let workspaceSelect = $('#changeWorkspace');

    if(workspaceSelect.length !== 0)
    {

        workspaceSelect.click(function(){
            let select = document.createElement('select');
            $(select).attr('id', 'changeWorkspaceMenu');

            apiRequest('GET', 'tickets/workspaces', {}).done(function(json){
                $.each(json.data, function(i, v){
                    let option = document.createElement('option');
                    $(option).html(v.name);
                    $(option).attr('value', v.id);

                    $(select).append(option);
                });

                $(select).val(getWorkspace());

                workspaceSelect.off("click"); // Remove click event
                workspaceSelect.empty(); // Clear title
                workspaceSelect.append(select); // Add select
                workspaceSelect.change(function()
                {
                    changeWorkspace($(select).val());
                });
            });
        });
    }

    // Ticket view page assign button
    $('#assign-button').click(function(e){
        loadAssigneeSelect();
    });
});
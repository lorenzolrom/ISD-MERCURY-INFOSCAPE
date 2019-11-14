let open = true; // Are open requests currently displayed?
let updatesLoaded = false;

function getRequestForm()
{
    let title = $('#title').val();
    let type = $('#type').val();
    let category = $('#category').val();
    let desiredDate = $('#desiredDate').val();

    tinyMCE.triggerSave();
    let description = $('#editor').val();

    return {
        title: title,
        type: type,
        category: category,
        desiredDate: desiredDate,
        description: description,
    };
}

function toggle()
{
    // Toggle between showing old and new requests

    let button = document.querySelector('#toggleButton');
    let title = document.querySelector('#title');

    if(open)
    {
        button.innerHTML = "<i class='icon'>history</i>View Open Requests";
        title.textContent = 'Closed Requests';
        open = false;

        loadClosed();
    }
    else
    {
        button.innerHTML = "<i class='icon'>history</i>View Closed Requests";
        title.textContent = 'Open Requests';

        open = true;
        loadOpen();
    }
}

function loadOpen()
{
    apiRequest('GET', 'tickets/requests/open', {}).done(function(json){
        if(json.code === 200)
        {
            showRequests(json.data);
        }
    });
}

function loadClosed()
{
    apiRequest('GET', 'tickets/requests/closed', {}).done(function(json){
        if(json.code === 200)
        {
            showRequests(json.data);
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });
}

function showRequests(tickets)
{
    let rows = [];
    let refs = [];

    $.each(tickets, function(i, v){
        refs.push(v.workspace + '-' + v.number);

        rows.push([
            v.workspaceName,
            v.number,
            v.title,
            v.type,
            v.category,
            v.status,
            v.updated
        ]);
    });

    setupTable({
        target: 'requests',
        header: ['Workspace', '#', 'Title', 'Type', 'Category', 'Status', 'Updated'],
        sortColumn: 0,
        linkColumn: 1,
        href: baseURI + 'tickets/requests/',
        refs: refs,
        rows: rows
    });
}

function create()
{
    apiRequest('POST', 'tickets/requests', getRequestForm()).done(function(json){
        if(json.code === 201)
        {
            window.location.replace(baseURI + 'tickets/requests/' + json.data.workspace + '-' + json.data.number);
        }
    });
}

function update(workspace, number)
{
    tinyMCE.triggerSave();
    let description = $('#editor').val();

    apiRequest('PUT', 'tickets/requests/' + workspace + '/' + number, {description: description}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + 'tickets/requests/' + workspace + '-' + number);
        }
    });
}

function loadUpdates(workspace, number)
{
    if(updatesLoaded)
        return;

    apiRequest('GET', 'tickets/requests/' + workspace + '/' + number + '/updates', {}).done(function(json){
        let rows = [];

        $.each(json.data, function(i,v){
            rows.push([
                v.time,
                v.description
            ]);
        });

        setupTable({
            target: 'update-region',
            header: ['Time', 'Description'],
            sortColumn: 0,
            rows: rows,
            rawText: true
        });
    });

    updatesLoaded = true;
}

$(document).ready(function()
{
    if ($('#requests').length !== 0) {
        loadOpen();
    }
});
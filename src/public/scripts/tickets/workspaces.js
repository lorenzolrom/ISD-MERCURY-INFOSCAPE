function getForm()
{
    let name = $('#name').val();
    let teams = $('#teams').val();

    return {
        name: name,
        teams: teams
    };
}

function getAttributeForm()
{
    let type = $('#type').val();
    let code = $('#code').val();
    let name = $('#name').val();

    return {
        type: type,
        code: code,
        name: name
    };
}

function load()
{
    apiRequest('GET', 'tickets/workspaces', {}).done(function(json){
        let rows = [];
        let refs = [];

        let select = $('#requestPortal');

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.name,
                v.requestPortal === 1 ? 'Yes' : ''
            ]);

            // Create select menu
            let option = document.createElement('option');
            option.setAttribute('value', v.id);
            option.appendChild(document.createTextNode(v.name));

            $(select).append(option);
        });

        setupTable({
            target: 'results',
            header: ['Name', 'Request Portal'],
            sortColumn: 0,
            sortMethod: 'asc',
            linkColumn: 0,
            href: baseURI + 'tickets/admin/workspaces/',
            refs: refs,
            rows: rows
        });
    });
}

function loadAttributes()
{
    apiRequest('GET', 'tickets/workspaces/' + workspaceId + '/attributes', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.type,
                v.code,
                v.name,
            ]);
        });

        setupTable({
            target: 'configure-results',
            header: ['Type', 'Code', 'Name'],
            sortColumn: 0,
            sortMethod: 'asc',
            linkColumn: 1,
            href: "javascript: editAttribute('{{%}}')",
            usePlaceholder: true,
            refs: refs,
            rows: rows
        });
    });
}

function create()
{
    apiRequest('POST', 'tickets/workspaces', getForm()).done(function(json){
        if(json.code === 201)
        {
            window.location.replace (baseURI + "tickets/admin/workspaces?NOTICE=Workspace created");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function save(id)
{
    apiRequest('PUT', 'tickets/workspaces/' + id, getForm()).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "tickets/admin/workspaces?NOTICE=Workspace saved");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function remove(id)
{
    apiRequest('DELETE', 'tickets/workspaces/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + "tickets/admin/workspaces?NOTICE=Workspace deleted");
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}

function setRequestPortal()
{
    let workspace = $('#requestPortal').val();

    apiRequest('PUT', 'tickets/workspaces/' + workspace + '/requestPortal', {}).done(function(json){
        if(json.code === 204)
        {
            showNotifications('notice', ['Request Portal has been set']);
            load();
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function addAttribute()
{
    apiRequest('POST', 'tickets/workspaces/' + workspaceId + '/attributes', getAttributeForm()).done(function(json){
        if(json.code === 201)
        {
            showNotifications('notice', ['Attribute has been created']);
            loadAttributes();
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function editAttribute(id)
{
    apiRequest('GET', 'tickets/workspaces/' + workspaceId + '/attributes/' + id, {}).done(function(json){
        $('#editType').val(json.data.type);
        $('#editCode').val(json.data.code);
        $('#editName').val(json.data.name);
    });

    $('#attributeEdit').dialog().dialog("option", {
        position: {
            my: 'top',
            at: 'right',
            of: event
        }
    });

    $('#editId').val(id);
}

function saveAttribute()
{
    let id = $('#editId').val();
    let form = {
        code: $('#editCode').val(),
        name: $('#editName').val()
    };

    apiRequest('PUT', 'tickets/workspaces/' + workspaceId + '/attributes/' + id, form).done(function(json){
        if(json.code === 204)
        {
            showNotifications('notice', ['Attribute has been updated']);
            loadAttributes();
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function deleteAttribute()
{
    let id = $('#editId').val();

    apiRequest('DELETE', 'tickets/workspaces/' + workspaceId + '/attributes/' + id, {}).done(function(json){
        if(json.code === 204)
        {
            showNotifications('notice', ['Attribute has been deleted']);
            loadAttributes();
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

if($('#results').length !== 0)
{
    load();
}

if($('#configure-results').length !== 0)
{
    loadAttributes();
}
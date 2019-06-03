function load()
{
    apiRequest('GET', 'tickets/workspaces', {}).done(function(json){
        let rows = [];
        let refs = [];


        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.name
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Name'],
            sortColumn: 0,
            sortMethod: 'asc',
            linkColumn: 0,
            href: baseURI + 'tickets/admin/workspaces/',
            refs: refs,
            rows: rows
        });
    });
}

function create()
{
    let name = $('#name').val();

    apiRequest('POST', 'tickets/workspaces', {
        name: name
    }).done(function(json){
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
    let name = $('#name').val();

    apiRequest('PUT', 'tickets/workspaces/' + id, {
        name: name
    }).done(function(json){
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

if($('#results').length !== 0)
{
    load();
}
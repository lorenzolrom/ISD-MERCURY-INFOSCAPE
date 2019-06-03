function getForm()
{
    let name = $('#name').val();
    let users = $('#users').val();

    return {
        name: name,
        users: users
    };
}

function load()
{
    apiRequest('GET', 'tickets/teams', {}).done(function(json){
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
            href: baseURI + 'tickets/admin/teams/',
            refs: refs,
            rows: rows
        });
    });
}

function create()
{
    apiRequest('POST', 'tickets/teams', getForm()).done(function(json){
        if(json.code === 201)
        {
            window.location.replace (baseURI + "tickets/admin/teams?NOTICE=Team created");
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
    apiRequest('PUT', 'tickets/teams/' + id, getForm()).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "tickets/admin/teams?NOTICE=Team updated");
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
    apiRequest('DELETE', 'tickets/teams/' + id, {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "tickets/admin/teams?NOTICE=Team deleted");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

if($('#results').length !== 0)
{
    load();
}
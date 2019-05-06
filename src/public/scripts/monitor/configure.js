function load()
{
    apiRequest('GET', 'hostCategories', {}).done(function(json){
        let refs = [];
        let rows = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);
            rows.push([
                v.name,
                v.displayed ? '✓' : ''
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Name', 'Displayed'],
            linkColumn: 0,
            sortColumn: 0,
            sortMethod: 'asc',
            href: baseURI + 'monitor/configure/',
            rows: rows,
            refs: refs
        });
    });
}

function getForm()
{
    let name = $('#name').val();
    let displayed = $('#displayed').val();
    let hosts = $('#hosts').val();

    return {
        name: name,
        displayed: displayed,
        hosts: hosts
    };
}

function create()
{
    apiRequest('POST', 'hostCategories', getForm()).done(function(json){
        if(json.code === 201)
        {
            window.location.replace (baseURI + "monitor/configure?NOTICE=Category created");
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
    apiRequest('PUT', 'hostCategories/' + id, getForm()).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "monitor/configure?NOTICE=Category updated");
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
    apiRequest('DELETE', 'hostCategories/' + id, {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "monitor/configure?NOTICE=Category deleted");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}

$(document).ready(function(){
    if(document.getElementById("results"))
        load();
});
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
            href: baseURI + 'netcenter/monitor/configure/',
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
            window.location.replace (baseURI + "netcenter/monitor/configure?SUCCESS=Category created");
        }
    });

    return false;
}

function save(id)
{
    apiRequest('PUT', 'hostCategories/' + id, getForm()).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "netcenter/monitor/configure?SUCCESS=Category updated");
        }
    });

    return false;
}

function remove(id)
{
    apiRequest('DELETE', 'hostCategories/' + id, {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "netcenter/monitor/configure?SUCCESS=Category deleted");
        }
    });
}

$(document).ready(function(){
    if(document.getElementById("results"))
        load();
});
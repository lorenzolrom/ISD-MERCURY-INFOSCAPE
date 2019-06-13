function getForm()
{
    let name = $('#name').val();
    let code = $('#code').val();

    return {
        name: name,
        code: code
    }
}

function search()
{
    apiRequest('POST', 'lockshop/systems/search', getForm()).done(function(json){
        let refs = [];
        let rows = [];

        $.each(json.data, function(i,v){
            refs.push(v.id);

            rows.push([
                v.code,
                v.name
            ])
        });

        setupTable({
            target: 'results',
            header: ['Code', 'Name'],
            linkColumn: 0,
            sortColumn: 0,
            sortMethod: 'asc',
            href: baseURI + 'lockshop/systems/',
            rows: rows,
            refs: refs
        });

        setSearchCookie('lockSystemSearch', getForm());
        unveil();
    });

    return false;
}

function create(){
    apiRequest('POST', 'lockshop/systems', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'lockshop/systems/' + json.data.id  + '?NOTICE=System created');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function update(id)
{
    apiRequest('PUT', 'lockshop/systems/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'lockshop/systems/' + id + '?NOTICE=System updated');
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
    apiRequest('DELETE', 'lockshop/systems/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'lockshop/systems?NOTICE=System deleted');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function loadCores(id){}

function loadKeys(id){}

$(document).ready(function(){
    if(document.getElementById("results"))
        restoreSearch('lockSystemSearch', search);
});
function getForm()
{
    let alias = $('#alias').val();
    let destination = $('#destination').val();
    let disabled = $('#disabled').val();

    return {
        alias: alias,
        destination: destination,
        disabled: disabled
    };
}

function searchAliases()
{
    apiRequest('POST', 'urlaliases/search', getForm()).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);
            rows.push([
                v.alias,
                v.destination,
                v.disabled === '1' ? '✓' : ''
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Alias', 'Destination', 'Disabled'],
            sortColumn: 0,
            sortMethod: 'asc',
            linkColumn: 0,
            href: baseURI + 'netcenter/web/urlaliases/',
            refs: refs,
            rows: rows
        });

        setSearchCookie('urlAliasSearch', getForm());
        unveil();
    });

    return false;
}

function saveChanges(id)
{
    apiRequest('PUT', 'urlaliases/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'netcenter/web/urlaliases?SUCCESS=URL Alias updated');
    });

    return false;
}

function createEntry()
{
    apiRequest('POST', 'urlaliases', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'netcenter/web/urlaliases?SUCCESS=URL Alias created');
        
    });

    return false;
}

function deleteEntry(id)
{
    apiRequest('DELETE', 'urlaliases/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + "netcenter/web/urlaliases?SUCCESS=URL Alias deleted");
        
    });

    return false;
}

$(document).ready(function(){
    if(!document.getElementById("results"))
        return;

    let last =  getCookie('urlAliasSearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $('#alias').val(last.alias);
        $('#destination').val(last.destination);
        //$('#disabled').val(last.disabled);

        searchAliases();
    }
});
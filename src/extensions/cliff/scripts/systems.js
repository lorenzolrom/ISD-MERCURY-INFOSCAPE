function getForm()
{
    let code = document.getElementById('code').value;
    let name = document.getElementById('name').value;

    return {
        code: code,
        name: name
    };
}

function search()
{
    apiRequest('POST', 'locksystems/search', getForm()).done(function(json){

        if(json.code === 200)
        {
            let refs = [];
            let rows = [];

            $.each(json.data, function(i, v){
                refs.push(v.id);

                rows.push([
                    v.code,
                    v.name,
                ]);
            });

            $('#results').mlTable({
                refs: refs,
                rows: rows,
                sortColumn: 0,
                sortMethod: 'asc',
                header: ['Code', 'Name'],
                linkColumn: 0,
                href: baseURI + 'cliff/systems/'
            });
        }

        setSearchCookie('cliffsystemsearch', getForm());
        unveil();
    });

    return false;
}

function create()
{
    apiRequest('POST', 'locksystems', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'cliff/systems?SUCCESS=System created');
    });

    return false;
}

function update(id)
{
    apiRequest('PUT', 'locksystems/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'cliff/systems?SUCCESS=System updated');
    });

    return false;
}

function del(id)
{
    apiRequest('DELETE', 'locksystems/' + id, []).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'cliff/systems?SUCCESS=System deleted');
    });
}

function goToKeys(id)
{
    alert('WIP');
}

function goToCores(id)
{
    alert('WIP');
}

/**
 * If a search cookie is set, re-run the search
 */
function restoreSearch()
{
    if(!document.getElementById("results"))
        return;

    let last =  getCookie('cliffsystemsearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $('#code').val(last.code);
        $('#name').val(last.name);
        search();
    }
}

$(document).ready(function(){
    restoreSearch();
});
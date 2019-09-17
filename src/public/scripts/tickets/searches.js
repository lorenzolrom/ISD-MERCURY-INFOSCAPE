function loadSearches()
{
    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/searches', {}).done(function(json){
        if(json.code === 200)
        {
            let rows = [];

            $.each(json.data, function(i, v){
                rows.push([v.replace(/_/g, ' '), "<a href='" + baseURI + "tickets/agent/search/edit/" + v + "'>EDIT</a>", "<a href=\"javascript: deleteSearch('" + v + "');\">DELETE</a>"]);
            });

            setupTable({
                target: 'mySearches',
                header: ['Name', '', ''],
                rows: rows,
                rawText: true
            });
        }
    });
}

function deleteSearch(name)
{
    apiRequest('DELETE', 'tickets/workspaces/' + getWorkspace() + '/searches/' + name, {}).done(function(json){
        if(json.code === 204)
        {
            loadSearches();
            showNotifications('notice', ['Search Deleted']);
        }
    });
}

function gotoEditSearch(){}

$(document).ready(function() {

    if ($('#mySearches').length !== 0)
    {
        loadSearches();
    }
});
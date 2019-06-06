function selectWorkspace()
{
    veil();
    let workspace = $('#workspace').val();

    apiRequest('GET', 'tickets/workspaces/' + workspace, {}).done(function(json){
        if(json.code !== 200)
            showNotifications('error', ['Workspace is not valid']);
        else
        {
            setCookie('agentWorkspace', workspace);
            $('#workspace').prop('disabled', true);
            window.location.reload();
        }

        unveil();
    });

    return false;
}

function quickSearch()
{
    let query = $('search').val();
}

function updateFilter()
{

}

function loadWidgets()
{

}

if($('#filter').length !== 0)
{
    updateFilter();
}

if($('#widgets').length !== 0)
{
    loadWidgets();
}
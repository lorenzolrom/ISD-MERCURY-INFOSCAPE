function selectWorkspace()
{
    let workspace = $('#workspace').val();
    changeWorkspace(workspace);
}

function changeWorkspace(workspace)
{
    console.log(workspace);
    veil();
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

function getWorkspace()
{
    return getCookie('agentWorkspace');
}

function showTickets(tickets)
{
    let rows = [];
    let refs = [];

    $.each(tickets, function(i, v){
        refs.push(v.number);

        rows.push([
            v.number,
            v.type,
            v.severity,
            v.title,
            v.status
        ]);
    });

    setupTable({
        target: 'tickets',
        header: ['Number', 'Type', 'Severity', 'Title', 'Status'],
        sortColumn: 0, // TODO: add last update time and sort by that
        linkColumn: 0,
        href: baseURI + 'tickets/agent/',
        refs: refs,
        rows: rows
    });
}

function quickSearch()
{
    let query = $('search').val();
    applyLoadingImage('tickets');

    $('#filter').val('currentSearch');


    return false;
}

function updateFilter()
{
    let filter = $('#filter').val();

    if(filter === 'currentSearch')
        return;

    applyLoadingImage('tickets');

    if(filter === 'myAssignments')
    {
        apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/myAssignments', {}).done(function(json){
            showTickets(json.data);
        });
    }
    else if(filter === 'open')
    {
        apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/open', {}).done(function(json){
            showTickets(json.data);
        });
    }
    else if(filter === 'closed')
    {
        apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/tickets/search', {
            status:['clo']
        }).done(function(json){
            showTickets(json.data);
        });
    }
}

function loadWidgets()
{

}

function updateEditForm()
{
    let status = $('#status').val();

    if(status !== 'clo')
        $('.closureCode').hide();
    else
        $('.closureCode').show();
}

$(document).ready(function(){

    if($('#filter').length !== 0)
    {
        updateFilter();
    }

    if($('#widgets').length !== 0)
    {
        loadWidgets();
    }

    if($('#ticket-form').length !== 0)
    {
        updateEditForm();
    }

    let workspaceSelect = $('#changeWorkspace');

    if(workspaceSelect.length !== 0)
    {

        workspaceSelect.click(function(){
            let select = document.createElement('select');
            $(select).attr('id', 'changeWorkspaceMenu');

            apiRequest('GET', 'tickets/workspaces', {}).done(function(json){
                $.each(json.data, function(i, v){
                    let option = document.createElement('option');
                    $(option).html(v.name);
                    $(option).attr('value', v.id);

                    $(select).append(option);
                });

                workspaceSelect.off("click"); // Remove click event
                workspaceSelect.empty(); // Clear title
                workspaceSelect.append(select); // Add select
                workspaceSelect.change(function()
                {
                    changeWorkspace($(select).val());
                });
            });
        });
    }
});
let updatesLoaded = false;
let assigneesLoaded = false;
let assigneesSelectLoaded = false;
let linkedLoaded = false;
let historyLoaded = false;

function getTicketForm()
{
    let title = $('#title').val();
    let contact = $('#contact').val();
    let severity = $('#severity').val();
    let type = $('#type').val();
    let category = $('#category').val();
    let status = $('#status').val();
    let closureCode = $('#closureCode').val();
    let desiredDate = $('#desiredDate').val();
    let scheduledDate = $('#scheduledDate').val();
    let assignees = $('#assignees').val();
    let notifyAssignees = $('#notifyAssignees').prop("checked");
    let notifyContact = $('#notifyContact').prop("checked");

    tinyMCE.triggerSave();
    let description = $('#editor').val();

    return {
        title: title,
        contact: contact,
        severity: severity,
        type: type,
        category: category,
        status: status,
        closureCode: closureCode,
        desiredDate: desiredDate,
        scheduledDate: scheduledDate,
        description: description,
        assignees: assignees,
        notifyAssignees: notifyAssignees,
        notifyContact: notifyContact
    };
}

function getAdvancedSearchForm()
{
    let title = $('#title').val();
    let number = $('#number').val();
    let contact = $('#contact').val();
    let severity = $('#severity').val();
    let type = $('#type').val();
    let category = $('#category').val();
    let status = $('#status').val();
    let closureCode = $('#closureCode').val();
    let desiredDateStart = $('#desiredDateStart').val();
    let desiredDateEnd = $('#desiredDateEnd').val();
    let scheduledDateStart = $('#scheduledDateStart').val();
    let scheduledDateEnd = $('#scheduledDateEnd').val();
    let assignees = $('#assignees').val();
    let description = $('#description').val();

    return {
        number: number,
        title: title,
        contact: contact,
        severity: severity,
        type: type,
        category: category,
        status: status,
        closureCode: closureCode,
        desiredDateStart: desiredDateStart,
        desiredDateEnd: desiredDateEnd,
        scheduledDateStart: scheduledDateStart,
        scheduledDateEnd: scheduledDateEnd,
        description: description,
        assignees: assignees
    };
}

function selectWorkspace()
{
    let workspace = $('#workspace').val();
    return changeWorkspace(workspace);
}

function changeWorkspace(workspace)
{
    if(workspace === getWorkspace())
        return;

    veil();
    apiRequest('GET', 'tickets/workspaces/' + workspace, {}).done(function(json){
        if(json.code !== 200)
        {
            showNotifications('error', ['Workspace is not valid']);
            unveil();
        }
        else
        {
            setCookie('agentWorkspace', workspace);
            $('#workspace').prop('disabled', true);
            window.location.reload();
        }
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
            v.title,
            v.type,
            v.category,
            v.severity,
            v.status,
            v.scheduledDate,
            v.lastUpdate
        ]);
    });

    setupTable({
        target: 'tickets',
        header: ['#', 'Title', 'Type', 'Category', 'Severity', 'Status', 'Scheduled', 'Updated'],
        sortColumn: 0, // TODO: add last update time and sort by that
        linkColumn: 0,
        href: "javascript: goToViewTicket('{{%}}');",
        usePlaceholder: true,
        refs: refs,
        rows: rows
    });
}

function quickSearch()
{
    let query = $('#search').val();
    applyLoadingImage('tickets');

    $('#filter').val('currentSearch');

    apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/tickets/quickSearch', {query: query}).done(function(json){
        showTickets(json.data);
    });

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
        apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/closed', {}).done(function(json){
            showTickets(json.data);
        });
    }
    else
    {
        // Check for saved search
        apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/searches/' + filter, {}).done(function(json){
            if(json.code === 200)
            {
                let search = {};

                $.each(json.data, function(i, v){
                    try
                    {
                        search[i] = JSON.parse(v);
                    }
                    catch(err)
                    {
                        search[i] = v;
                    }

                });

                apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/tickets/search', search).done(function(json){
                    if(json.code === 200)
                    {
                        showTickets(json.data);
                        unveil();
                    }
                    
                });
            }
            else
            {
                showNotifications('error', json.data.errors);
            }
        });
    }
}

function updateEditForm()
{
    let status = $('#status').val();

    if(status !== 'clo')
        $('.closureCode').hide();
    else
        $('.closureCode').show();
}

function create()
{
    apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/tickets', getTicketForm()).done(function(json){
        if(json.code === 201)
        {
            window.location.replace(baseURI + 'tickets/agent/' + json.data.number);
        }
        
    });

    return false;
}

function update(number)
{
    pauseLockUpdate();
    apiRequest('PUT', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number, getTicketForm()).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + 'tickets/agent/' + number);
        }
        else
        {
            startLockUpdate();
        }
    });

    return false;
}

function loadUpdates(number)
{
    if(updatesLoaded)
        return;

    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/updates', {}).done(function(json){
        let rows = [];

        $.each(json.data, function(i,v){
            rows.push([
                v.time,
                v.name + ' (' + v.user + ')',
                v.description
            ]);
        });

        setupTable({
            target: 'update-region',
            header: ['Time', 'User', 'Description'],
            sortColumn: 0,
            rows: rows,
            rawText: true
        });
    });

    updatesLoaded = true;
}

function loadAssignees(number, override = false)
{
    if(assigneesLoaded && !override)
        return;

    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/assignees', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){

            if(v.users.length === 0)
            {
                rows.push([v.name, 'REMOVE']);
                refs.push(v.id);
            }
            else
            {
                $.each(v.users, function(j,w){
                    rows.push([v.name + ' - ' + w.name + ' (' + w.username + ')', 'REMOVE']);
                    refs.push(v.id + '-' + w.id);
                });
            }
        });

        setupTable({
            target: 'assignee-region',
            header: ['Assignee', ''],
            href: "javascript: removeAssignee('" + number + "', '{{%}}')",
            usePlaceholder: true,
            linkColumn: 1,
            rows: rows,
            refs: refs
        });
    });

    assigneesLoaded = true;
}

function loadHistory(number, override = false)
{
    if(historyLoaded && !override)
        return;

    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/history', {}).done(function(json){
        let rows = [];

        $.each(json.data, function(i,v){
            let changes = "";

            $.each(v.changes, function(j,w){
                changes += w + "<br/>";
            });

            rows.push([
                v.time,
                v.user,
                changes
            ]);
        });

        setupTable({
            target: 'history-region',
            header: ['Time', 'User', 'Changes'],
            sortColumn: 0,
            rows: rows,
            rawText: true
        });
    });

    historyLoaded = true;
}

function loadAssigneeSelect()
{
    if(assigneesSelectLoaded)
        return;

    let select = document.getElementById('assigneeSelect'); // This is the multiple select element

    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/assignees', {}).done(function(json){
        // Structure of json is:
        // array of teams, each with 'id' and 'name' and 'users'
        // 'users' is an array of users with 'id', 'name', 'username'

        // Create select with options of class 'team' if a team, and 'user' if a user

        $.each(json.data, function(i, v){

            // Create team option
            let teamOption = document.createElement('option');
            teamOption.classList.add('team');
            teamOption.setAttribute('value', v.id);

            let teamName = document.createTextNode(v.name);
            teamOption.appendChild(teamName);

            select.appendChild(teamOption);

            $.each(v.users, function(j,w){
                let userOption = document.createElement('option');
                userOption.classList.add('user');
                userOption.setAttribute('value', v.id + '-' + w.id);

                let userName = document.createTextNode(w.name + ' (' + w.username + ')');
                userOption.appendChild(userName);

                select.appendChild(userOption);
            });
        });
    });

    assigneesSelectLoaded = true;
}

function assignTicket(number)
{
    veil();
    let assignees = $('#assigneeSelect').val();
    let overwrite = $('#overwriteAssignees').prop("checked");

    apiRequest('PUT', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/assignees', {assignees: assignees, overwrite: overwrite}).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Ticket assigned']);

            if(assigneesLoaded)
                loadAssignees(number, true);

            if(historyLoaded)
                loadHistory(number, true);

            $('#assign-button-dialog').dialog('close');

            unveil();
        }
    });

    return false;
}

function removeAssignee(number, code)
{
    veil();
    apiRequest('DELETE', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/assignee', {assignee: code}).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Assignee removed']);

            if(assigneesLoaded)
                loadAssignees(number, true);

            if(historyLoaded)
                loadHistory(number, true);
            unveil();
        }
    });
}

function loadLinked(number, override = false)
{
    if(linkedLoaded && !override)
        return;

    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/linked', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){

            refs.push(v.number);

            rows.push([v.number, v.title, 'UNLINK']);
        });

        setupTable({
            target: 'linked-region',
            header: ['#', 'Title', ''],
            href: "javascript: unlink('" + number + "', '{{%}}')",
            usePlaceholder: true,
            linkColumn: 2,
            rows: rows,
            refs: refs
        });
    });

    linkedLoaded = true;
}

function link(number)
{
    veil();
    let linkedNumber = $('#linkNumber').val();

    apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/link', {linkedNumber: linkedNumber}).done(function(json){
        if(json.code === 201)
        {
            showNotifications('success', ['Ticket Linked']);

            if(linkedLoaded)
                loadLinked(number, true);
            if(historyLoaded)
                loadHistory(number, true);
            $('#link-button-dialog').dialog('close');
            unveil();
        }
    });

    return false;
}

function unlink(number, linkedNumber)
{
    veil();
    apiRequest('DELETE', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + number + '/link/' + linkedNumber, {}).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Ticket Unlinked']);

            if(linkedLoaded)
                loadLinked(number, true);
            if(historyLoaded)
                loadHistory(number, true);
            unveil();
        }
    });
}

function runSearch()
{
    showTickets(getSearchResults(getAdvancedSearchForm()));
}

function getSearchResults(search)
{
    apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/tickets/search', search).done(function(json){
        if(json.code === 200)
        {
            showTickets(json.data);
            unveil();
        }
    });
}

function saveSearch()
{
    let searchForm = getAdvancedSearchForm();
    searchForm.name = $('#searchName').val();
    searchForm.assignees = JSON.stringify(searchForm.assignees);
    searchForm.severity = JSON.stringify(searchForm.severity);
    searchForm.type = JSON.stringify(searchForm.type);
    searchForm.category = JSON.stringify(searchForm.category);
    searchForm.status = JSON.stringify(searchForm.status);
    searchForm.closureCode = JSON.stringify(searchForm.closureCode);

    // stringify arrays

    apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/searches', searchForm).done(function(json){
        if(json.code === 201)
        {
            showNotifications('success', ['Search saved']);
            unveil();
        }
        else if(json.code === 204)
        {
            showNotifications('success', ['Search updated']);
            unveil();
        }
    });
}

function loadSavedSearches()
{
    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/searches', {}).done(function(json){
        if(json.code !== 200)
            return;

        let filter = document.querySelector('#filter');

        $.each(json.data, function(i, v){
            let option = document.createElement('option');
            option.appendChild(document.createTextNode(v.replace(/_/g, ' ')));
            option.setAttribute('value', v);

            filter.appendChild(option);
        });
    });
}

function loadSearch()
{
    veil();

    // Get last part of URL (the search name)
    let searchName = window.location.pathname.split("/").slice(-1)[0];
    // Don't worry about trailing '/', this URL should only be gotten to by saved search page, which will not include it

    // load a pre-populate form
    // Check for saved search
    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/searches/' + searchName, {}).done(function(json){
        if(json.code === 200)
        {
            let search = {};

            $.each(json.data, function(i, v){
                try
                {
                    search[i] = JSON.parse(v);
                }
                catch(err)
                {
                    search[i] = v;
                }

            });

            $.each(search, function(i, v){
                let input = $('#' + i);

                if(input.length)
                {
                    $(input).val(v);
                }
            });

            $('#searchName').val(json.data.name.replace(/_/g, ' '));
            unveil();
        }
    });

}

function setupWidgets()
{
    let widgets = document.getElementById('widgets');

    // Remove anything from the widgets div
    while(widgets.firstChild)
    {
        widgets.removeChild((widgets.firstChild));
    }

    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/widgets', {}).done(function(json){
        if(json.code !== 200)
            return;

        $.each(json.data, function(i, v){
            // Create widget
            let widget = document.createElement('div');
            widget.classList.add('widget');

            let title = document.createElement('h3');
            title.appendChild(document.createTextNode(v.search));
            widget.appendChild(title);

            let image = document.createElement('img');
            image.src = baseURI + 'media/animations/loading.gif';
            image.classList.add('ticketLoading');
            image.alt = '';
            widget.appendChild(image);

            widgets.appendChild(widget);

            let list = document.createElement('ul');

            // Get widget search results
            // Check for saved search
            apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/searches/' + v.search.replace(/ /g, '_'), {}).done(function(json){
                if(json.code === 200)
                {
                    let search = {};

                    $.each(json.data, function(i, v){
                        try
                        {
                            search[i] = JSON.parse(v);
                        }
                        catch(err)
                        {
                            search[i] = v;
                        }

                    });

                    apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/tickets/search', search).done(function(json){
                        if(json.code === 200)
                        {
                            $.each(json.data, function(j, w){
                                let li = document.createElement('li');
                                let a = document.createElement('a');
                                a.appendChild(document.createTextNode(w.number + ' - ' + w.title));
                                a.href = "javascript: goToViewTicket('" +  w.number + "');";

                                li.appendChild(a);

                                list.appendChild(li);
                            });

                            widget.removeChild(widget.lastChild);

                            if(json.data.length === 0)
                                widget.appendChild(document.createTextNode('No results available'));
                            else
                                widget.appendChild(list);
                        }
                    });
                }
            });
        });
    });
}

function openPopupWindow(url)
{
    window.open(baseURI + url, "", "width=1024,height=900");
}

function goToNewTicket()
{
    openPopupWindow('tickets/agent/new');
}

function goToViewTicket(number)
{
    openPopupWindow('tickets/agent/' + number);
}

function closeTicketWindow()
{
    window.close();
}

function refreshAgent()
{
    setupWidgets();
    updateFilter();
}

function displayWorkspaceSelect()
{
    let workspaceSelect = document.querySelector('#changeWorkspace');
    workspaceSelect.removeAttribute('onclick');

    let select = document.createElement('select');
    select.setAttribute("onfocusout", "resetWorkspaceSelect()");

    $(select).attr('id', 'changeWorkspaceMenu');

    apiRequest('GET', 'tickets/workspaces', {}).done(function(json){
        $.each(json.data, function(i, v){
            let option = document.createElement('option');
            $(option).html(v.name);
            $(option).attr('value', v.id);

            $(select).append(option);
        });

        $(select).val(getWorkspace());


        workspaceSelect.removeChild(workspaceSelect.firstChild); // Remove title
        workspaceSelect.appendChild(select); // Add select

        $(workspaceSelect).change(function()
        {
            changeWorkspace($(select).val());
        });
    });
}

function resetWorkspaceSelect()
{
    let workspaceSelect = document.querySelector('#changeWorkspace');

    while(workspaceSelect.firstChild)
    {
        workspaceSelect.removeChild(workspaceSelect.firstChild);
    }

    workspaceSelect.appendChild(document.createTextNode(workspaceName));
    workspaceSelect.setAttribute('onclick', 'displayWorkspaceSelect()');
}

$(document).ready(function(){

    if($('#filter').length !== 0)
    {
        updateFilter();
        loadSavedSearches();
    }

    if($('#widgets').length !== 0)
        setupWidgets();

    if($('#ticket-form').length !== 0)
    {
        updateEditForm();
    }

    let workspaceSelect = document.querySelector('#changeWorkspace');

    if(workspaceSelect)
    {
        workspaceSelect.setAttribute('onclick', 'displayWorkspaceSelect()');
    }

    // Ticket view page assign button
    $('#assign-button').click(function(e){
        loadAssigneeSelect();
    });
});
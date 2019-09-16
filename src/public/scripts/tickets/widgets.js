function deleteWidget(id)
{
    apiRequest('DELETE', 'tickets/workspaces/' + getWorkspace() + '/widgets/' + id, {}).done(function(json){
        if(json.code === 204)
        {
            loadWidgetList();
            showNotifications('notice', ['Widget deleted']);
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });
}

function addWidget()
{
    veil();
    let search = document.getElementById('search').value;

    apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/widgets', {search: search.replace(/_/g, ' ')}).done(function(json){
        if(json.code === 201)
        {
            loadWidgetList();
            showNotifications('notice', ['Widget added']);
            $('#addWidget-button-dialog').dialog('close');
            unveil();
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function loadWidgetList()
{
    // Load widget list
    apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/widgets', {}).done(function(json){
        if(json.code !== 200)
        {
            showNotifications('error', json.data.errors);
            return;
        }

        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);
            rows.push([v.search, 'DELETE'])
        });

        setupTable({
            target: 'widgetList',
            header: ['Search Name', ''],
            rows: rows,
            refs: refs,
            href: "javascript: deleteWidget('{{%}}')",
            usePlaceholder: true,
            linkColumn: 1
        });
    });
}

$(document).ready(function(){
    let widgetList = $('#widgetList');

    if(widgetList.length !== 0)
    {
        let select = document.getElementById('search');

        // Load search select
        apiRequest('GET', 'tickets/workspaces/' + getWorkspace() + '/searches', {}).done(function(json){
            if(json.code !== 200)
            {
                showNotifications('error', json.data.errors);
                return;
            }

            $.each(json.data, function(i, v){
                let option = document.createElement('option');
                option.value = v;
                option.appendChild(document.createTextNode(v.replace(/_/g, ' ')));

                select.appendChild(option);
            });
        });

        loadWidgetList();
    }
});
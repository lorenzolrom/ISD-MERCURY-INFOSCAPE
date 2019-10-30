$(document).ready(function(){
    apiRequest('GET', 'vhosts/' + vhostId + '/logs', {}).done(function(json){
        if(json.code === 200)
        {
            let accessLogs = json.data.access;
            let errorLogs = json.data.error;

            let logs = accessLogs.concat(errorLogs);

            let rows = [];
            let refs = [];

            $.each(logs, function(i, v){
                refs.push([v]);

                let parts = v.split('.');

                rows.push([
                    parts[0].toUpperCase(),
                    parts[1]
                ]);
            });

            setupTable({
                target: 'results',
                header: ['Type', 'Date'],
                linkColumn: 1,
                href: "javascript: viewLog('{{%}}')",
                usePlaceholder: true,
                rows: rows,
                refs: refs,
                sortColumn: 0,
                sortMethod: 'asc'
            });
        }
    });
});

function viewLog(logName)
{
    veil();

    apiRequest('GET', 'vhosts/' + vhostId + '/logs/' + logName, {}).done(function(json){
       if(json.code !== 200)
       {
           unveil();
           return;
       }

        let logDisplay = $('#log-display');
        $(logDisplay).html('');

        let logContents = document.createElement('textarea');
        $(logContents).attr('readonly', 'true');
        $(logContents).html(json.data);

        logDisplay.append(logContents);
        logDisplay.dialog().dialog('option', {
            minWidth: 900
        });

        unveil();
    });
}
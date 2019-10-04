function loadLogs()
{
    let query = $('#query').val();
    let lines = $('#lines').val();

    applyLoadingImage('results');

    apiRequest('POST', 'dhcplogs', {query: query, lines: lines}).done(function(json){
        if(json.code === 200)
        {
            let rows = [];

            $.each(json.data, function(i, v){
                rows.push([v.date, v.type, v.mac, v.ip, v.interface, v.server]);
            });

            setupTable({
                target: 'results',
                header: ['Date', 'Type', 'MAC', 'IP', 'Interface', 'Server'],
                rows: rows
            });
        }
    });

    return false;
}
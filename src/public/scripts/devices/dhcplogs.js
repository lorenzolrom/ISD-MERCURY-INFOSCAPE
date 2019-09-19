$(document).ready(function(){
    apiRequest('GET', 'dhcplogs', {}).done(function(json){
        if(json.code === 200)
        {
            let rows = [];

            $.each(json.data, function(i, v){
                rows.push([v]);
            });

            setupTable({
                target: 'results',
                header: ['Line'],
                rows: rows
            });
        }
    });
});
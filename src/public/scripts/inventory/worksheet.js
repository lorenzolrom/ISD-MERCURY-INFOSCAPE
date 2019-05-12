function loadWorksheet()
{
    apiRequest('GET', 'assets/worksheet', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.assetTag);

            rows.push([
                v.assetTag,
                v.commodityCode + ' (' + v.commodityName + ')',
                'REMOVE'
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Asset #', 'Commodity', ''],
            sortColumn: 0,
            sortMethod: 'asc',
            linkColumn: 2,
            href: "javascript: remove('{{%}}')",
            usePlaceholder: true,
            refs: refs,
            rows: rows
        });
    });
}

function remove(tag)
{
    veil();

    apiRequest('DELETE', 'assets/worksheet/' + tag, {}).done(function(json){
        if(json.code === 204)
        {
            loadWorksheet();
            showNotifications('notice', ['Asset removed']);
            unveil();
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}

function clearWorksheet()
{
    veil();

    apiRequest('DELETE', 'assets/worksheet', {}).done(function(json){
        if(json.code === 200)
        {
            loadWorksheet();
            showNotifications('notice', [json.data.removed + ' assets removed']);
            unveil();
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}

function verify(){}

$(document).ready(function(){
    loadWorksheet();
});
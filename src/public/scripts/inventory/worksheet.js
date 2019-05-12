function loadWorksheet()
{
    apiRequest('GET', 'assets/worksheet', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.assetTag);

            rows.push([
                v.assetTag,
                v.commodityCode,
                v.commodityName,
                v.assetType,
                v.serialNumber,
                v.location,
                v.warehouse,
                v.verified ? "✓" : "",
                'REMOVE'
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Asset Tag', 'Code', 'Name', 'Asset Type', 'Serial Number', 'Location', 'Warehouse', 'Verified', ''],
            sortColumn: 0,
            sortMethod: 'asc',
            linkColumn: 8,
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
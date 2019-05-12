let warehouseCodes = [];
let buildingCodes = [];

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

function loadWarehouses()
{
    if(warehouseCodes.length !== 0)
        return warehouseCodes;

    apiRequest('GET', 'warehouses', {}).done(function(json){

        if(json.code === 200)
        {
            $.each(json.data, function(i, v){
                warehouseCodes.push(v.code);
            });
        }
    });

    return warehouseCodes;
}

function loadBuildings()
{
    if(buildingCodes.length !== 0)
        return buildingCodes;

    apiRequest('GET', 'buildings', {}).done(function(json){

        if(json.code === 200)
        {
            $.each(json.data, function(i, v){
                buildingCodes.push(v.code);
            });
        }
    });

    return buildingCodes;
}

function loadLocations()
{
    let code = $('#buildingCode').val();

    apiRequest('POST', 'buildings/search', {code: code}).done(function(json){
        if(json.code === 200)
        {
            if(json.data.length !== 1)
                return;

            if(json.data[0].code !== code) // If code is not an exact match
                return;

            let id = json.data[0].id;

            // Get locations
            apiRequest('GET', 'buildings/' + id + '/locations', {}).done(function(json){
                if(json.code === 200)
                {
                    let codes = [];

                    $.each(json.data, function(i, v){
                        codes.push(v.code);
                    });

                    setupAutoCompleteList({
                        target: 'locationCode',
                        items: codes
                    });
                }
            });
        }
    });
}

function verify()
{
    apiRequest('PUT', 'assets/worksheet/verify', {}).done(function(json){
        if(json.code === 204)
        {
            loadWorksheet();
            showNotifications('notice', ['Assets have been verified']);
            unveil();
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}

function unVerify()
{
    apiRequest('PUT', 'assets/worksheet/unverify', {}).done(function(json){
        if(json.code === 204)
        {
            loadWorksheet();
            showNotifications('notice', ['Assets have been un-verified']);
            unveil();
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}

function setWarehouse()
{
    veil();
    apiRequest('PUT', 'assets/worksheet/warehouse', {
        warehouseCode: $('#warehouseCode').val()
    }).done(function(json){
        if(json.code === 204)
        {
            loadWorksheet();
            showNotifications('notice', ['Assets have been moved to warehouse']);
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

function setLocation()
{
    veil();
    apiRequest('PUT', 'assets/worksheet/location', {
        locationCode: $('#locationCode').val(),
        buildingCode: $('#buildingCode').val()
    }).done(function(json){
        if(json.code === 204)
        {
            loadWorksheet();
            showNotifications('notice', ['Assets have been moved to location']);
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

$(document).ready(function(){
    loadWorksheet();

    let setWarehouseButton = $('#setWarehouse-button');
    let setLocationButton = $('#setLocation-button');

    // Auto-complete setup
    $(setWarehouseButton).click(function(){
        setupAutoCompleteList({
            target: 'warehouseCode',
            items: loadWarehouses()
        });
    });

    $(setLocationButton).click(function(){
        setupAutoCompleteList({
            target: 'buildingCode',
            items: loadBuildings(),
            select: function(e, ui)
            {
                $('#buildingCode').val(ui.item.value);
                loadLocations()
            }
        });
    });
});
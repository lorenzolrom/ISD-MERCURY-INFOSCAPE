let childrenLoaded = false;
let warehouseCodes = [];

function addToWorksheet()
{
    let table = $('#results table')[0];

    if(typeof(table) === 'undefined')
    {
        showNotifications('error', ['Search must be run before adding to worksheet']);
        unveil();
        return;
    }

    let checked = $('.dt-checkboxes:checkbox:checked');

    if(checked.length === 0)
    {
        showNotifications('error', ['No assets selected']);
        unveil();
        return;
    }

    let assets = [];

    $.each(checked, function(i, v){
        assets.push($(v).parent().parent().find('a')[0].innerHTML);
    });

    showNotifications('notice', ["This will eventually add " + assets.length + " assets to the worksheet"]);
    unveil();
}

function searchAssets()
{
    let assetTag = $("#assetTag").val();
    let serialNumber = $("#serialNumber").val();
    let buildingCode = $("#buildingCode").val();
    let locationCode = $("#locationCode").val();
    let warehouseCode = $("#warehouseCode").val();
    let purchaseOrder = $("#purchaseOrder").val();
    let manufacturer = $("#manufacturer").val();
    let model = $("#model").val();
    let commodityCode = $("#commodityCode").val();
    let commodityName = $("#commodityName").val();
    let commodityType = $("#commodityType").val();
    let assetType = $("#assetType").val();

    let inWarehouse = [];
    let isDiscarded = [];
    let isVerified = [];

    if($("#warehouseYes").is(":checked"))
        inWarehouse.push(1);
    if($("#warehouseNo").is(":checked"))
        inWarehouse.push(0);
    if($("#discardedYes").is(":checked"))
        isDiscarded.push(1);
    if($("#discardedNo").is(":checked"))
        isDiscarded.push(0);
    if($("#verifiedYes").is(":checked"))
        isVerified.push(1);
    if($("#verifiedNo").is(":checked"))
        isVerified.push(0);

    let search = {
        assetTag: assetTag,
        serialNumber: serialNumber,
        inWarehouse: inWarehouse,
        isDiscarded: isDiscarded,
        buildingCode: buildingCode,
        locationCode: locationCode,
        warehouseCode: warehouseCode,
        purchaseOrder: purchaseOrder,
        manufacturer: manufacturer,
        model: model,
        commodityCode: commodityCode,
        commodityName: commodityName,
        commodityType: commodityType,
        assetType: assetType,
        isVerified: isVerified
    };

    apiRequest("POST", "assets/search", search).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.assetTag);

            rows.push([
                v.inWorksheet,
                '',
                v.assetTag,
                v.commodityCode,
                v.commodityName,
                v.assetType,
                v.serialNumber,
                v.location,
                v.warehouse,
                v.verified ? "✓" : "",
                v.returnOrderNumber
            ]);
        });

        setupTable({
            target: 'asset-results',
            checkboxes: true,
            checkboxColumn: 1,
            header: ['In W.S.', '', 'Asset Tag', 'Code', 'Name', 'Asset Type', 'Serial Number', 'Location', 'Warehouse', 'Verified', 'R.O. #'],
            sortColumn: 2,
            linkColumn: 2,
            href: baseURI + "inventory/assets/",
            refs: refs,
            rows: rows
        });

        setSearchCookie('assetSearch', search);

        unveil();
    });

    return false;
}

function loadReturns(assetTag){}

function loadChildren(assetTag)
{
    if(childrenLoaded)
        return;

    apiRequest("GET", "assets/" + assetTag + "/children", {}).done(function(json){
        let rows = [];
        let refs = [];

        console.log(json.data);

        $.each(json.data, function(i, v){
            refs.push(v.assetTag);

            rows.push([
                v.assetTag,
                v.commodityName
            ]);
        });

        setupTable({
            target: 'children-region',
            header: ['Asset Tag', 'Commodity Name'],
            sortColumn: 0,
            linkColumn: 0,
            href: baseURI + "inventory/assets/",
            refs: refs,
            rows: rows
        });

        childrenLoaded = true;
    });
}

// Auto-search
$(document).ready(function(){
    if(!document.getElementById("asset-results"))
        return;

    let last = getCookie('assetSearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $("#assetTag").val(last.assetTag);
        $("#serialNumber").val(last.serialNumber);
        $("#buildingCode").val(last.buildingCode);
        $("#locationCode").val(last.locationCode);
        $("#warehouseCode").val(last.warehouseCode);
        $("#purchaseOrder").val(last.purchaseOrder);
        $("#manufacturer").val(last.manufacturer);
        $("#model").val(last.model);
        $("#commodityCode").val(last.commodityCode);
        $("#commodityName").val(last.commodityName);
        $("#commodityType").val(last.commodityType);
        $("#assetType").val(last.assetType);

        // Checkboxes
        if(!last.inWarehouse.includes(0))
            $("#warehouseNo").prop('checked', false);
        if(!last.inWarehouse.includes(1))
            $("#warehouseYes").prop('checked', false);
        if(!last.isDiscarded.includes(0))
            $("#discardedNo").prop('checked', false);
        if(last.isDiscarded.includes(1))
            $("#discardedYes").prop('checked', true);
        if(!last.isVerified.includes(0))
            $("#verifiedNo").prop('checked', false);
        if(!last.isVerified.includes(1))
            $("#verifiedYes").prop('checked', false);

        searchAssets();
    }
});

function saveChanges(asset)
{
    let assetTag = $('#assetTag').val();
    let serialNumber = $('#serialNumber').val();
    let notes = $('#notes').val();

    apiRequest('PUT', 'assets/' + asset, {
        assetTag: assetTag,
        serialNumber: serialNumber,
        notes: notes
    }).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "inventory/assets/" + assetTag + "/?NOTICE=Asset updated");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

/**
 * Loads warehouse codes from the API if they haven't been loaded before
 */
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

function linkToParent(tag)
{
    veil();
    let parentAssetTag = $('#linkToParentAssetTag').val();

    apiRequest('POST', 'assets/' + tag + '/parent', {
        parentAssetTag: parentAssetTag
    }).done(function(json){
        if(json.code === 204)
        {
            window.location.reload();
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}


function unlinkFromParent(tag)
{
    apiRequest('DELETE', 'assets/' + tag + '/parent', {}).done(function(json){
        if(json.code === 204)
        {
            window.location.reload();
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}
// Hide appropriate buttons on view page
$(document).ready(function(){
    if(!document.getElementById("asset-display"))
        return;

    // Unlink/Link to parent
    if($('#parentAssetTag').text().length > 0)
        $('#linkToParent-button').hide();
    else
    {
        $('#parent-info').hide();
        $('#unlinkFromParent-button').hide();
    }

    // Verify
    if($('#verifyDate').text().length > 0)
        $('#verify-button').hide();
    else
        $('#unVerify-button').hide();

    // Location
    if($('#locationCode').text().length > 0)
        $('#assignToLocation-button').hide();
    else
    {
        $('.location-info').hide();
        $('#changeLocation-button').hide();
    }

    // Warehouse
    let returnToWarehouseButton = $('#returnToWarehouse-button');
    let changeWarehouseButton = $('#changeWarehouse-button');

    if($('#warehouseCode').text().length > 0)
        returnToWarehouseButton.hide();
    else
    {
        $('#warehouse-info').hide();
        changeWarehouseButton.hide();
    }

    // Discarded
    if($('#discardDate').text().length > 0)
    {
        $('.hideIfDiscarded').hide();
        $('#verify-info').hide();
    }
    else
        $('#discard-info').hide();

    // Auto-complete setup
    $(returnToWarehouseButton).click(function(){
        setupAutoCompleteList({
            target: 'returnWarehouseCode',
            items: loadWarehouses()
        });
    });

    $(changeWarehouseButton).click(function(){
        setupAutoCompleteList({
            target: 'changeWarehouseCode',
            items: loadWarehouses()
        });
    });
});
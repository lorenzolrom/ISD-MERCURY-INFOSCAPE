let warehouseCodes = [];
let vendorCodes = [];

function getWarehouseCodes()
{
    if(warehouseCodes.length !== 0)
        return warehouseCodes;

    apiRequest('GET', 'warehouses', {}).done(function(json){
        $.each(json.data, function(i, v){
            warehouseCodes.push(v.code);
        });
    });

    return warehouseCodes;
}

function getVendorCodes()
{
    if(vendorCodes.length !== 0)
        return vendorCodes;

    apiRequest('GET', 'vendors', {}).done(function(json){
        $.each(json.data, function(i, v){
            vendorCodes.push(v.code);
        });
    });

    return vendorCodes;
}

function getSearchForm()
{
    let number = $('#number').val();
    let vendor = $('#vendor').val();
    let warehouse = $('#warehouse').val();
    let status = $('#status').val();
    let orderStart = $('#orderStart').val();
    let orderEnd = $('#orderEnd').val();

    return {
        number: number,
        vendor: vendor,
        warehouse: warehouse,
        status: status,
        orderStart: orderStart,
        orderEnd: orderEnd
    };
}

function getEditForm()
{
    let orderDate = $('#orderDate').val();
    let vendor = $('#vendor').val();
    let warehouse = $('#warehouse').val();
    let notes = $('#notes').val();

    return {
        orderDate: orderDate,
        vendor: vendor,
        warehouse: warehouse,
        notes: notes
    };
}

function getCommodityForm()
{
    let commodityCode = $('#commodityCode').val();
    let commodityQuantity = $('#commodityQuantity').val();
    let communityUnitCost = $('#commodityUnitCost').val();

    return {
        commodity: commodityCode,
        quantity: commodityQuantity,
        unitCost: communityUnitCost
    };
}

function getCostItemForm()
{
    let costItemCost = $('#costItemCost').val();
    let costItemNotes = $('#costItemNotes').val();

    return {
        cost: costItemCost,
        notes: costItemNotes
    };
}

function getReceiveForm()
{
    let startAssetTag = $('#startAssetTag').val();
    let receiveDateInput = $('#receiveDateInput').val();

    return {
        startAssetTag: startAssetTag,
        receiveDate: receiveDateInput
    };
}

function search()
{
    apiRequest('POST', 'purchaseorders/search', getSearchForm()).done(function(json){
        let refs = [];
        let rows = [];

        $.each(json.data, function(i, v){
            refs.push(v.number);

            rows.push([
                v.number,
                v.status,
                v.orderDate,
                v.warehouseCode + ' (' + v.warehouseName + ')',
                v.vendorCode + ' (' + v.vendorName + ')'
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Number', 'Status', 'Order Date', 'Warehouse', 'Vendor'],
            href: baseURI + 'netcenter/inventory/purchaseorders/',
            linkColumn: 0,
            sortColumn: 0,
            refs: refs,
            rows: rows
        });

        setSearchCookie('purchaseOrderSearch', getSearchForm());
        unveil();
    });

    return false;
}

function updateWarehouseName(code)
{
    apiRequest('POST', 'warehouses/search', {
        code: code
    }).done(function(json){
        if(json.data.length > 0)
            $('#warehouseName').html(json.data[0].name);
    });
}

function updateVendorName(code)
{
    apiRequest('POST', 'vendors/search', {
        code: code
    }).done(function(json){
        if(json.data.length > 0)
            $('#vendorName').html(json.data[0].name);
    });
}

function create()
{
    apiRequest('POST', 'purchaseorders', getEditForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'netcenter/inventory/purchaseorders/' + json.data.id + '?SUCCESS=Purchase Order created');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function save(number)
{
    apiRequest('PUT', 'purchaseorders/' + number, getEditForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'netcenter/inventory/purchaseorders/' + number + '?SUCCESS=Purchase Order updated');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function loadCommodities(number)
{
    apiRequest('GET', 'purchaseorders/' + number + '/commodities', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.commodityCode + ' (' + v.commodityName + ')',
                v.unitCost.toFixed(2),
                v.quantity,
                (v.quantity * v.unitCost).toFixed(2),
                'REMOVE'
            ]);
        });

        setupTable({
            target: 'commodity-region',
            header: ['Commodity', 'Unit Cost', 'Quantity', 'Total', ''],
            href: "javascript: removeCommodity('" + number + "', '{{%}}')",
            usePlaceholder: true,
            linkColumn: 4,
            rows: rows,
            refs: refs
        });
    });
}

function loadCostItems(number)
{
    apiRequest('GET', 'purchaseorders/' + number + '/costitems', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.cost.toFixed(2),
                v.notes,
                'REMOVE'
            ]);
        });

        setupTable({
            target: 'cost-region',
            header: ['Cost', 'Notes', ''],
            href: "javascript: removeCostItem('" + number + "', '{{%}}')",
            usePlaceholder: true,
            linkColumn: 2,
            rows: rows,
            refs: refs
        });
    });
}

function addCommodity(number)
{
    apiRequest('POST', 'purchaseorders/' + number + '/commodities', getCommodityForm()).done(function(json){
        if(json.code === 201)
        {
            loadCommodities(number);
            showNotifications('success', ['Commodity added']);
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function addCostItem(number)
{
    apiRequest('POST', 'purchaseorders/' + number + '/costitems', getCostItemForm()).done(function(json){
        if(json.code === 201)
        {
            loadCostItems(number);
            showNotifications('success', ['Cost Item added']);
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function removeCommodity(number, item)
{
    apiRequest('DELETE', 'purchaseorders/' + number + '/commodities/' + item, {}).done(function(json){
        if(json.code === 204)
        {
            loadCommodities(number);
            showNotifications('success', ['Commodity removed']);
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function removeCostItem(number, item)
{
    apiRequest('DELETE', 'purchaseorders/' + number + '/costitems/' + item, {}).done(function(json){
        if(json.code === 204)
        {
            loadCostItems(number);
            showNotifications('success', ['Cost Item removed']);
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function send(number)
{
    apiRequest('PUT', 'purchaseorders/' + number + '/send', {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "netcenter/inventory/purchaseorders/" + number + "?SUCCESS=Purchase Order has been sent");
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });
}

function cancel(number)
{
    apiRequest('PUT', 'purchaseorders/' + number + '/cancel', {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "netcenter/inventory/purchaseorders/" + number + "?SUCCESS=Purchase Order has been canceled");
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });
}

function receive(number)
{
    apiRequest('PUT', 'purchaseorders/' + number + '/receive', getReceiveForm()).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "netcenter/inventory/purchaseorders/" + number + "?SUCCESS=Purchase Order has been received");
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

$(document).ready(function(){
    if(document.getElementById("results"))
        restoreSearch('purchaseOrderSearch', search);
    else if(document.getElementById("edit-form"))
    {
        let vendor = $('#vendor');
        let warehouse = $('#warehouse');

        vendor.focus(function(){
            setupAutoCompleteList({
                target: 'vendor',
                items: getVendorCodes(),
                select: function(e, ui)
                {
                    vendor.val(ui.item.value);
                    updateVendorName(ui.item.value);
                }
            })
        });

        warehouse.focus(function(){
            setupAutoCompleteList({
                target: 'warehouse',
                items: getWarehouseCodes(),
                select: function(e, ui)
                {
                    warehouse.val(ui.item.value);
                    updateWarehouseName(ui.item.value);
                }
            });
        });
    }
    else if(document.getElementById('po-display'))
    {
        let send = $('#send');
        let receive = $('#receive-button');
        let cancel = $('#cancel');
        let addCommodity = $('#addCommodity-button');
        let addCostItem = $('#addCostItem-button');
        let edit = $('#edit-button');

        if($('#sendDate').text().length > 0)
        {
            $(send).hide();
            $(addCommodity).hide();
            $(addCostItem).hide();
        }
        else
        {
            $(receive).hide();
        }

        if($('#receiveDate').text().length > 0 || $('#cancelDate').text().length > 0)
        {
            $(edit).hide();
            $(receive).hide();
            $(cancel).hide();
            $(addCommodity).hide();
            $(addCostItem).hide();
            $(send).hide();
        }
    }
});
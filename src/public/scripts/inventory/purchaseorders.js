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
            href: baseURI + 'inventory/purchaseorders/',
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

function updateWarehouseName()
{
    apiRequest('POST', 'warehouses/search', {
        code: $('#warehouse').val()
    }).done(function(json){
        if(json.data.length > 0)
            $('#warehouseName').html(json.data[0].name);
    });
}

function updateVendorName()
{
    apiRequest('POST', 'vendors/search', {
        code: $('#vendors').val()
    }).done(function(json){
        if(json.data.length > 0)
            $('#vendorName').html(json.data[0].name);
    });
}

function create()
{
    apiRequest('POST', 'purchaseorders', getEditForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'inventory/purchaseorders/' + json.data.id + '?NOTICE=Purchase Order created');
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
            window.location.replace(baseURI + 'inventory/purchaseorders/' + number + '?NOTICE=Purchase Order updated');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
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
            href: "javascript: removeCommodity('{{%}}')",
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
            href: "javascript: removeCostItem('{{%}}')",
            usePlaceholder: true,
            linkColumn: 4,
            rows: rows,
            refs: refs
        });
    });
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
                    updateVendorName();
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
                    updateWarehouseName();
                }
            });
        });
    }
    else if(document.getElementById('po-display'))
    {
        let send = $('#send');
        let receive = $('#receive');
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
            $(cancel).hide();
        }

        if($('#receiveDate').text().length > 0 || $('#cancelDate').text().length > 0)
        {
            $(edit).hide();
            $(receive).hide();
            $(cancel).hide();
        }
    }
});
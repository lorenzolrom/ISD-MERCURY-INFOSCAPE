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

$(document).ready(function(){
    if(document.getElementById("results"))
        restoreSearch('purchaseOrderSearch', search);
});
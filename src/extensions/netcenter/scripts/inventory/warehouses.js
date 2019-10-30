/**
 * Load current warehouses
 */
function loadWarehouses()
{
    apiRequest("GET", "warehouses", {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i,v){
            refs.push(v.id);

            rows.push([
                v.code,
                v.name
            ]);
        });

        setupTable({
            target:'results',
            type:'table',
            header: ['Code', 'Name'],
            sortColumn: 0,
            sortMethod: "asc",
            linkColumn: 0,
            href: baseURI + "netcenter/inventory/warehouses/",
            refs: refs,
            rows: rows
        });
    });
}

function createWarehouse()
{
    let code = $('#code').val();
    let name = $('#name').val();

    apiRequest("POST", "warehouses", {
        code: code,
        name: name
    }).done(function(json){
        if(json.code === 201)
        {
            window.location.replace (baseURI + "netcenter/inventory/warehouses?SUCCESS=Warehouse created");
        }
    });

    return false;
}

function deleteWarehouse(id)
{
    apiRequest("DELETE", "warehouses/" + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + "netcenter/inventory/warehouses?SUCCESS=Warehouse deleted");
    });
}

function saveChanges(id)
{
    let code = $('#code').val();
    let name = $('#name').val();

    apiRequest("PUT", "warehouses/" + id, {
        code: code,
        name: name
    }).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "netcenter/inventory/warehouses?SUCCESS=Warehouse updated");
        }
    });

    return false;
}

// If results div is present, load the asset types
if($('#results').length !== 0)
{
    loadWarehouses();
}
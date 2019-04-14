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
                v.name,
                (v.closed ? "✓" : "")
            ]);
        });

        setupTable({
            target:'results',
            type:'table',
            header: ['Code', 'Name', 'Closed'],
            sortColumn: 0,
            sortMethod: "asc",
            linkColumn: 0,
            href: baseURI + "inventory/warehouses/",
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
            window.location.replace (baseURI + "inventory/warehouses?NOTICE=Warehouse created");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function deleteWarehouse(id)
{
    apiRequest("DELETE", "warehouses/" + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + "inventory/warehouses?NOTICE=Warehouse deleted");
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
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
            window.location.replace (baseURI + "inventory/warehouses?NOTICE=Warehouse updated");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

// If results div is present, load the asset types
if($('#results').length !== 0)
{
    loadWarehouses();
}
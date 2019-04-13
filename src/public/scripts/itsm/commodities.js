/**
 *
 * @returns {boolean}
 */
function searchCommodities()
{
    let code = $('#code').val();
    let name = $('#name').val();
    let manufacturer = $('#manufacturer').val();
    let model = $('#model').val();

    let commodityTypes = $('#commodityType').val();
    let assetTypes = $('#assetType').val();

    apiRequest("POST", "commodities/search", {
        code: code,
        name: name,
        manufacturer: manufacturer,
        model: model,
        commodityType: commodityTypes,
        assetType: assetTypes
    }).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.code,
                v.name,
                v.commodityType,
                v.assetType,
                v.manufacturer,
                v.model
            ]);
        });

        setupTable({
            target: 'results',
            type: 'table',
            header: ['Code', 'Name', 'Type', 'Asset Type', 'Manufacturer', 'Model'],
            sortColumn: 0,
            sortMethod: 'asc',
            linkColumn: 0,
            href: baseURI + "inventory/commodities/",
            refs: refs,
            rows: rows
        });

        unveil();
    });

    return false;
}

function createCommodity()
{
    let code = $('#code').val();
    let name = $('#name').val();
    let manufacturer = $('#manufacturer').val();
    let model = $('#model').val();
    let unitCost = $('#unitCost').val();
    let commodityType =$('#commodityType').val();
    let assetType =$('#assetType').val();

    apiRequest("POST", "commodities", {
        code: code,
        name: name,
        manufacturer: manufacturer,
        model: model,
        unitCost: unitCost,
        commodityType: commodityType,
        assetType: assetType
    }).done(function(json){
        if(json.code === 201)
        {
            window.location.replace (baseURI + "inventory/commodities/" + json.data.id + "?NOTICE=Commodity created");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function saveChanges(id)
{
    let code = $('#code').val();
    let name = $('#name').val();
    let manufacturer = $('#manufacturer').val();
    let model = $('#model').val();
    let unitCost = $('#unitCost').val();
    let commodityType =$('#commodityType').val();
    let assetType =$('#assetType').val();

    apiRequest("PUT", "commodities/" + id, {
        id: id,
        code: code,
        name: name,
        manufacturer: manufacturer,
        model: model,
        unitCost: unitCost,
        commodityType: commodityType,
        assetType: assetType
    }).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "inventory/commodities/" + id + "?NOTICE=Commodity updated");
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
 *
 * @param id
 */
function deleteCommodity(id)
{
    apiRequest("DELETE", "commodities/" + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + "inventory/commodities?NOTICE=Commodity deleted");
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}
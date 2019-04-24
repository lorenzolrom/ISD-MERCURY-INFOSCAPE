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

    let search = {
        code: code,
        name: name,
        manufacturer: manufacturer,
        model: model,
        commodityType: commodityTypes,
        assetType: assetTypes
    };

    apiRequest("POST", "commodities/search", search).done(function(json){
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
            target: 'commodity-results',
            type: 'table',
            header: ['Code', 'Name', 'Type', 'Asset Type', 'Manufacturer', 'Model'],
            sortColumn: 0,
            sortMethod: 'asc',
            linkColumn: 0,
            href: baseURI + "inventory/commodities/",
            refs: refs,
            rows: rows
        });

        setSearchCookie('commoditySearch', search);

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

$(document).ready(function(){
    if(!document.getElementById("commodity-results"))
        return;

    let last =  getCookie('commoditySearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $('#code').val(last.code);
        $('#name').val(last.name);
        $('#manufacturer').val(last.manufacturer);
        $('#model').val(last.model);

        $('#commodityType').val(last.commodityType);
        $('#assetType').val(last.assetType);

        searchCommodities();
    }
});
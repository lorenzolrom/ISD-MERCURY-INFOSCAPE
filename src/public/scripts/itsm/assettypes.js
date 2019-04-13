/**
 * Load current assetTypes
 */
function loadAssetTypes()
{
    apiRequest("GET", "commodities/assetTypes", {}).done(function(json){
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
            href: baseURI + "inventory/assettypes/",
            refs: refs,
            rows: rows
        });
    });
}

/**
 *
 * @returns {boolean}
 */
function createAssetType()
{
    let code = $('#code').val();
    let name = $('#name').val();

    apiRequest("POST", "commodities/assetTypes", {
        code: code,
        name: name
    }).done(function(json){
        if(json.code === 201)
        {
            window.location.replace(baseURI + "inventory/assettypes?NOTICE=Asset type created");
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
 * @returns {boolean}
 */
function saveChanges(id)
{
    let code = $('#code').val();
    let name = $('#name').val();

    apiRequest("PUT", "commodities/assetTypes/" + id, {
        code: code,
        name: name
    }).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + "inventory/assettypes?NOTICE=Asset type updated");
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
function deleteAssetType(id)
{
    apiRequest("DELETE", "commodities/assetTypes/" + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + "inventory/assetTypes?NOTICE=Asset type deleted");
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}

// If results div is present, load the asset types
if($('#results').length !== 0)
{
    loadAssetTypes();
}
/**
 *
 * @param id
 * @returns {boolean}
 */
function saveChanges(id)
{
    let code = $('#code').val();
    let name = $('#name').val();

    apiRequest("PUT", "locations/" + id, {
        code: code,
        name: name
    }).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "locations/" + id + "?NOTICE=Location updated");
        }
        else if(json.code === 409)
        {
            showNotifications('error', json.data.errors);
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

/**
 *
 * @param buildingId
 * @returns {boolean}
 */
function createLocation(buildingId)
{
    let code = $('#code').val();
    let name = $('#name').val();

    apiRequest("POST", "locations/" + buildingId, {
        code: code,
        name: name,
    }).done(function(json){
        if(json.code === 201)
        {
            window.location.replace (baseURI + "locations/" + json.data.id + "?NOTICE=Location created");
        }
        else if(json.code === 409)
        {
            showNotifications('error', json.data.errors);
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

function deleteLocation(id, buildingId)
{
    apiRequest("DELETE", "locations/" + id, {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + "buildings/" + buildingId + "?NOTICE=Location deleted");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}
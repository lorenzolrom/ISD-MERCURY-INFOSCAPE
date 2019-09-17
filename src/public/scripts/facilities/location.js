/**
 *
 * @param id
 * @param buildingId
 * @returns {boolean}
 */
function saveChanges(id, buildingId)
{
    let code = $('#code').val();
    let name = $('#name').val();

    apiRequest("PUT", "locations/" + id, {
        code: code,
        name: name
    }).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "facilities/buildings/" + buildingId + "?SUCCESS=Location updated");
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
            window.location.replace (baseURI + "facilities/buildings/" + buildingId + "?SUCCESS=Location created");
        }
    });

    return false;
}

function deleteLocation(id, buildingId)
{
    apiRequest("DELETE", "locations/" + id, {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + "facilities/buildings/" + buildingId + "?SUCCESS=Location deleted");
        }
    });
}
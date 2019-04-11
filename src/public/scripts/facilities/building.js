let locationsLoaded = false;

function searchBuildings()
{
    let code = $('#code').val();
    let name = $('#name').val();
    let streetAddress = $('#streetAddress').val();
    let city = $('#city').val();
    let state = $('#state').val();
    let zipCode = $('#zipCode').val();

    apiRequest("POST", "buildings/search", {
        code: code,
        name: name,
        streetAddress: streetAddress,
        city: city,
        state: state,
        zipCode: zipCode
    }).done(function(json){

        let rows = [];
        let refs = [];

        $.each(json.data, function(i,v){
            refs.push(v.id);

            rows.push([
                v.code,
                v.name,
                v.streetAddress,
                v.city,
                v.state,
                v.zipCode
            ]);
        });

        setupTable({
            target: 'results',
            type: 'table',
            header: ['Code', 'Name', 'Street Address', 'City', 'State', 'Zip Code'],
            sortColumn: 0,
            linkColumn: 0,
            href: baseURI + "buildings/",
            refs: refs,
            rows: rows
        });

        unveil();
    });

    return false;
}

function loadLocations(id)
{
    if(locationsLoaded)
        return;

    apiRequest("GET", "buildings/" + id + "/locations", {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.code,
                v.name
            ]);
        });

        setupTable({
            target: 'locations-region',
            type: 'table',
            header: ['Code', 'Name'],
            sortColumn: 0,
            sortMethod: "asc",
            linkColumn: 0,
            href: baseURI + "locations/",
            refs: refs,
            rows: rows
        });

        locationsLoaded = true;
    });
}

/**
 * Save changes to the building
 *
 * @param id
 * @returns {boolean}
 */
function saveChanges(id)
{
    let code = $('#code').val();
    let name = $('#name').val();
    let streetAddress = $('#streetAddress').val();
    let city = $('#city').val();
    let state = $('#state').val();
    let zipCode = $('#zipCode').val();

    apiRequest("PUT", "buildings/" + id, {
        code: code,
        name: name,
        streetAddress: streetAddress,
        city: city,
        state: state,
        zipCode: zipCode
    }).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "buildings/" + id + "?NOTICE=Building updated");
        }
        else if(json.code === 409)
        {
            showNotifications('error', json.data);
            unveil();
        }
        else
        {
            showNotifications('error', [json.data.errors]);
            unveil();
        }
    });

    return false;
}

function createBuilding()
{
    let code = $('#code').val();
    let name = $('#name').val();
    let streetAddress = $('#streetAddress').val();
    let city = $('#city').val();
    let state = $('#state').val();
    let zipCode = $('#zipCode').val();

    apiRequest("POST", "buildings", {
        code: code,
        name: name,
        streetAddress: streetAddress,
        city: city,
        state: state,
        zipCode: zipCode
    }).done(function(json){
        if(json.code === 201)
        {
            window.location.replace (baseURI + "buildings/" + json.data.id + "?NOTICE=Building created");
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
 * Delete building
 *
 * @param id
 */
function deleteBuilding(id)
{
    apiRequest("DELETE", "buildings/" + id, {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + "buildings?NOTICE=Building deleted");
        }
        else
        {
            showNotifications('error', [json.data.errors]);
            unveil();
        }
    });
}
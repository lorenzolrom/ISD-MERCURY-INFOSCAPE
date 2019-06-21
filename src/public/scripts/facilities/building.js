let locationsLoaded = false;

function searchBuildings()
{
    let code = $('#code').val();
    let name = $('#name').val();
    let streetAddress = $('#streetAddress').val();
    let city = $('#city').val();
    let state = $('#state').val();
    let zipCode = $('#zipCode').val();
    let search = {
        code: code,
        name: name,
        streetAddress: streetAddress,
        city: city,
        state: state,
        zipCode: zipCode
    };

    apiRequest("POST", "buildings/search", search).done(function(json){

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
            target: 'building-results',
            type: 'table',
            header: ['Code', 'Name', 'Street Address', 'City', 'State', 'Zip Code'],
            sortColumn: 0,
            linkColumn: 0,
            href: baseURI + "facilities/buildings/",
            refs: refs,
            rows: rows
        });

        setSearchCookie('buildingSearch', search);

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
            href: baseURI + "facilities/locations/",
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
            window.location.replace (baseURI + "facilities/buildings/" + id + "?SUCCESS=Building updated");
        }
        else if(json.code === 409)
        {
            showNotifications('error', json.data);
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
            window.location.replace (baseURI + "facilities/buildings/" + json.data.id + "?SUCCESS=Building created");
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
            window.location.replace(baseURI + "facilities/buildings?SUCCESS=Building deleted");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}

$(document).ready(function(){
    if(!document.getElementById("building-results"))
        return;

    let last =  getCookie('buildingSearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $('#code').val(last.code);
        $('#name').val(last.name);
        $('#streetAddress').val(last.streetAddress);
        $('#city').val(last.city);
        $('#state').val(last.state);
        $('#zipCode').val(last.zipCode);

        searchBuildings();
    }
});
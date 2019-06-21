/**
 * Load current vendors
 */
function loadVendors()
{
    apiRequest("GET", "vendors", {}).done(function(json){

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
            href: baseURI + "inventory/vendors/",
            refs: refs,
            rows: rows
        });
    });
}

function deleteVendor(id)
{
    apiRequest('DELETE', 'vendors/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + "inventory/vendors?SUCCESS=Vendor deleted");
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
    let streetAddress = $('#streetAddress').val();
    let city = $('#city').val();
    let state = $('#state').val();
    let zipCode = $('#zipCode').val();
    let phone = $('#phone').val();
    let fax = $('#fax').val();

    apiRequest('PUT', 'vendors/' + id, {
        code: code,
        name: name,
        streetAddress: streetAddress,
        city: city,
        state: state,
        zipCode: zipCode,
        phone: phone,
        fax: fax
    }).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "inventory/vendors?SUCCESS=Vendor updated");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function createVendor()
{
    let code = $('#code').val();
    let name = $('#name').val();
    let streetAddress = $('#streetAddress').val();
    let city = $('#city').val();
    let state = $('#state').val();
    let zipCode = $('#zipCode').val();
    let phone = $('#phone').val();
    let fax = $('#fax').val();

    apiRequest('POST', 'vendors', {
        code: code,
        name: name,
        streetAddress: streetAddress,
        city: city,
        state: state,
        zipCode: zipCode,
        phone: phone,
        fax: fax
    }).done(function(json){
        if(json.code === 201)
        {
            window.location.replace (baseURI + "inventory/vendors?SUCCESS=Vendor created");
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
    loadVendors();
}
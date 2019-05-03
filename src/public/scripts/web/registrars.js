function loadRegistrars()
{
    apiRequest("GET", "registrars", {}).done(function(json){
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
            href: baseURI + "web/registrars/",
            refs: refs,
            rows: rows
        });
    });
}

function deleteRegistrar(id)
{
    apiRequest('DELETE', 'registrars/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + "web/registrars?NOTICE=Registrar deleted");
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
    let url = $('#url').val();
    let phone = $('#phone').val();

    apiRequest('PUT', 'registrars/' + id, {
        code: code,
        name: name,
        phone: phone,
        url: url
    }).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "web/registrars?NOTICE=Registrar updated");
        }
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function createRegistrar()
{
    let code = $('#code').val();
    let name = $('#name').val();
    let url = $('#url').val();
    let phone = $('#phone').val();

    apiRequest('POST', 'registrars', {
        code: code,
        name: name,
        phone: phone,
        url: url
    }).done(function(json){
        if(json.code === 201)
        {
            window.location.replace (baseURI + "web/registrars?NOTICE=Registrar created");
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
    loadRegistrars();
}
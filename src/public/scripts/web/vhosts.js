let registrarCodes = [];

function getForm()
{
    let subdomain = $('#subdomain').val();
    let domain = $('#domain').val();
    let name = $('#name').val();
    let status = $('#status').val();
    let host = $('#ipAddress').val();
    let registrar = $('#registrar').val();
    let registerDate = $('#registerDate').val();
    let expireDate = $('#expireDate').val();
    let renewCost = $('#renewCost').val();
    let notes = $('#notes').val();
    let webRoot = $('#webRoot').val();
    let logPath = $('#logPath').val();

    return {
        subdomain: subdomain,
        domain: domain,
        name: name,
        status: status,
        host: host,
        registrar: registrar,
        expireDate: expireDate,
        registerDate: registerDate,
        renewCost: renewCost,
        notes: notes,
        webRoot: webRoot,
        logPath: logPath
    };
}

function searchVHosts()
{
    let search = {
        subdomain: $('#subdomain').val(),
        domain: $('#domain').val(),
        name: $('#name').val(),
        status: $('#status').val(),
        host: $('#host').val(),
        registrar: $('#registrar').val(),
    };

    apiRequest('POST', 'vhosts/search', search).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);
            rows.push([
                v.subdomain,
                v.domain,
                v.registrarName,
                v.name,
                v.statusName,
                v.hostName
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Sub-Domain', 'Domain', 'Registrar', 'Name', 'Status', 'Host'],
            sortColumn: 1,
            sortMethod: 'asc',
            linkColumn: 0,
            href: baseURI + 'web/vhosts/',
            refs: refs,
            rows: rows
        });

        setSearchCookie('vHostSearch', search);

        unveil();
    });
    return false;
}

function saveChanges(id)
{
    apiRequest('PUT', 'vhosts/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'web/vhosts?SUCCESS=VHost updated');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function createVHost()
{
    apiRequest('POST', 'vhosts', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'web/vhosts?SUCCESS=VHost created');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function deleteVHost(id)
{
    apiRequest('DELETE', 'vhosts/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + "web/vhosts?SUCCESS=VHost deleted");
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
}

function getRegistrarCodes()
{
    if(registrarCodes.length !== 0)
        return registrarCodes;

    apiRequest('GET', 'registrars', {}).done(function(json){
        $.each(json.data, function(i, v){
            registrarCodes.push(v.code);
        });
    });

    return registrarCodes;
}

function updateRegistrarName()
{
    apiRequest('POST', 'registrars/search', {
        code: $('#registrar').val()
    }).done(function(json){
        if(json.data.length > 0)
        {
            $('#registrarName').html(json.data[0].name);
        }
    });
}

$(document).ready(function(){
    let registrar = $('#registrar');

    // If we are viewing/creating, set up registrar auto-complete
    if(!document.getElementById("results"))
    {
        registrar.focus(function(){
            setupAutoCompleteList({
                target: 'registrar',
                items: getRegistrarCodes(),
                select: function(e, ui)
                {
                    registrar.val(ui.item.value);
                    updateRegistrarName();
                }
            })
        });

        return;
    }

    let last =  getCookie('vHostSearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $('#subdomain').val(last.subdomain);
        $('#domain').val(last.domain);
        $('#name').val(last.name);
        $('#status').val(last.status);
        $('#host').val(last.host);
        registrar.val(last.registrar);

        searchVHosts();
    }
});
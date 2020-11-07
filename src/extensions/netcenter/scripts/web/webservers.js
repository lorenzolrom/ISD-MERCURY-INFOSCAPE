function getSearchForm()
{
    let ipAddress = document.getElementById('ipAddress').value;
    let systemName = document.getElementById('systemName').value;

    return {
        ipAddress: ipAddress,
        systemName: systemName
    };
}

function getForm()
{
    let host = document.getElementById('host').value;
    let webroot = document.getElementById('webroot').value;
    let logpath = document.getElementById('logpath').value;

    return {
        host: host,
        webroot: webroot,
        logpath: logpath
    }
}

function searchServers()
{
    apiRequest('POST', 'webservers/search', getSearchForm()).done(function(json){
        if(json.code === 200)
        {
            let refs = [];
            let rows = [];

            $.each(json.data, function(i, v){
                refs.push(v.host);

                rows.push([
                    v.systemName,
                    v.ipAddress
                ]);
            });

            $('#results').mlTable({
                refs: refs,
                rows: rows,
                sortColumn: 0,
                sortMethod: 'asc',
                header: ['System Name', 'IP Address'],
                linkColumn: 0,
                href: baseURI + 'netcenter/web/servers/'
            });

            setSearchCookie('webServerSearch', getSearchForm());
            unveil();
        }
    });

    return false;
}

let hosts = null;
let systemNames = [];

/**
 * Populates a local copy of all current hosts
 * @returns {{}}
 */
function getSystemNames()
{
    if(systemNames.length !== 0)
        return systemNames;

    apiRequest('GET', 'hosts', {}).done(function(json){
        hosts = json.data;

        $.each(json.data, function(i, v){
            systemNames.push(v.systemName);
        });
    });

    return systemNames;
}

let systemNameInput = document.getElementById('systemName');

/**
 * Find a matching system name and update IP address
 */
function updateIPAddress()
{
    let selectedSystemName = systemNameInput.value;

    $.each(hosts, function(i, v){
        if(v.systemName === selectedSystemName)
        {
            document.getElementById('ipAddress').value = v.ipAddress;
            document.getElementById('host').value = v.id;
        }
    });
}

/**
 * If a search cookie is set, re-run the search
 */
function restoreSearch()
{
    if(!document.getElementById("results"))
        return;

    let last =  getCookie('webServerSearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $('#ipAddress').val(last.ipAddress);
        $('#systemName').val(last.systemName);
        searchServers();
    }
}

function create()
{
    apiRequest('POST', 'webservers', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'netcenter/web/servers?SUCCESS=Web Server Created');
    });

    return false;
}

function save(host)
{
    apiRequest('PUT', 'webservers/' + host, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'netcenter/web/servers?SUCCESS=Web Server Updated');
    });

    return false;
}

function remove(host)
{
    apiRequest('DELETE', 'webservers/' + host, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'netcenter/web/servers?SUCCESS=Web Server Deleted');
    });
}

$(document).ready(function(){
    if(document.getElementById('results'))
        restoreSearch();
    else
    {
        systemNameInput.addEventListener('focus', function(){
            setupAutoCompleteList({
                target: 'systemName',
                items: getSystemNames(),
                select: function(e, ui)
                {
                    systemNameInput.value = ui.item.value;
                    updateIPAddress();
                }
            });
        });
    }
});
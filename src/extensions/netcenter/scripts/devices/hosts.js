function getFormData()
{
    let ipAddress = $('#ipAddress').val();
    let macAddress = $('#macAddress').val();
    let assetTag = $('#assetTag').val();
    let systemName = $('#systemName').val();
    let systemCPU = $('#systemCPU').val();
    let systemRAM = $('#systemRAM').val();
    let systemOS = $('#systemOS').val();
    let systemDomain = $('#systemDomain').val();

    return {
        ipAddress: ipAddress,
        macAddress: macAddress,
        assetTag: assetTag,
        systemCPU: systemCPU,
        systemDomain: systemDomain,
        systemName: systemName,
        systemOS: systemOS,
        systemRAM: systemRAM
    };
}

function searchHosts()
{
    let search = getFormData();

    apiRequest('POST', 'hosts/search', search).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.ipAddress,
                v.macAddress,
                v.assetTag,
                v.systemName
            ]);
        });

        setupTable({
            target: 'host-results',
            header: ['IP Address/FQDN', 'MAC Address', 'Asset', 'System Name'],
            sortColumn: 0,
            sortMethod: 'asc',
            linkColumn: 0,
            href: baseURI + 'netcenter/devices/hosts/',
            refs: refs,
            rows: rows
        });

        setSearchCookie('hostSearch', search);

        unveil();
    });

    return false;
}

function saveChanges(id)
{
    apiRequest('PUT', 'hosts/' + id, getFormData()).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "netcenter/devices/hosts?SUCCESS=Host updated");
        }
    });

    return false;
}

function createHost()
{
    apiRequest('POST', 'hosts', getFormData()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'netcenter/devices/hosts?SUCCESS=Host created');
    });

    return false;
}

function deleteHost(id)
{
    apiRequest('DELETE', 'hosts/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'netcenter/devices/hosts?SUCCESS=Host deleted');
    });
}

$(document).ready(function(){
    if(!document.getElementById("host-results"))
        return;

    let last =  getCookie('hostSearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $('#ipAddress').val(last.ipAddress);
        $('#macAddress').val(last.macAddress);
        $('#assetTag').val(last.assetTag);
        $('#systemName').val(last.systemName);
        $('#systemCPU').val(last.systemCPU);
        $('#systemRAM').val(last.systemRAM);
        $('#systemOS').val(last.systemOS);
        $('#systemDomain').val(last.systemDomain);

        searchHosts();
    }
});

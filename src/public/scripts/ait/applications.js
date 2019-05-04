function getForm()
{
    let number = $('#number').val();
    let name = $('#name').val();
    let description = $('#description').val();
    let type = $('#type').val();
    let owner = $('#owner').val();
    let host = $('#host').val();
    let vhost = $('#vhost').val();
    let port = $('#port').val();
    let lifeExpectancy = $('#lifeExpectancy').val();
    let dataVolume = $('#dataVolume').val();
    let authType = $('#authType').val();
    let status = $('#status').val();

    return {
        number: number,
        name: name,
        description: description,
        type: type,
        owner: owner,
        host: host,
        vhost: vhost,
        port: port,
        lifeExpectancy: lifeExpectancy,
        dataVolume: dataVolume,
        authType: authType,
        status: status
    };
}

function getEditForm()
{
    let name = $('#name').val();
    let status = $('#status').val();
    let owner = $('#owner').val();
    let type = $('#type').val();
    let lifeExpectancy = $('#lifeExpectancy').val();
    let authType = $('#authType').val();
    let description = $('#description').val();

    let dataHosts = $('#dataHosts').val();
    let appHosts = $('#appHosts').val();
    let dataVolume = $('#dataVolume').val();

    let vHosts = $('#vHosts').val();
    let publicFacing = $('#publicFacing').val();
    let webHosts = $('#webHosts').val();
    let port = $('#port').val();

    return{
        name: name,
        status: status,
        owner: owner,
        type: type,
        lifeExpectancy: lifeExpectancy,
        authType: authType,
        description: description,
        dataHosts: dataHosts,
        appHosts: appHosts,
        dataVolume: dataVolume,
        vHosts: vHosts,
        publicFacing: publicFacing,
        webHosts: webHosts,
        port: port
    };
}

function search()
{
    apiRequest('POST', 'applications/search', getForm()).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.number);

            rows.push([
                v.number,
                v.name,
                v.type,
                v.status,
                v.owner
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Number', 'Name', 'Type', 'Status', 'Owner'],
            sortColumn: 0,
            linkColumn: 0,
            href: baseURI + 'ait/applications/',
            refs: refs,
            rows: rows
        });

        setSearchCookie('applicationSearch', getForm());

        unveil();
    });

    return false;
}

function create()
{
    console.log(JSON.stringify(getEditForm()));
    apiRequest('POST', 'applications', getEditForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'ait/applications/' + json.data.id + '?NOTICE=Application created');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function save(num)
{
    apiRequest('PUT', 'applications/' + num, getEditForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'ait/applications/' + num + '?NOTICE=Application updated');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });
    return false;
}

$(document).ready(function(){
    if(document.getElementById("results"))
        restoreSearch('applicationSearch', search);
});
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
            header: ['Number', 'Name', 'Owner', 'Type', 'Status'],
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

$(document).ready(function(){
    if(document.getElementById("results"))
        restoreSearch('applicationSearch', search);
});
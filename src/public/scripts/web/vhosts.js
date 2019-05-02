function searchVHosts()
{
    let subdomain = $('#subdomain').val();
    let domain = $('#domain').val();
    let name = $('#name').val();
    let status = $('#status').val();
    let host = $('#host').val();
    let registrar = $('#registrar').val();

    let search = {
        subdomain: subdomain,
        domain: domain,
        name: name,
        status: status,
        host: host,
        registrarCode: registrar
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
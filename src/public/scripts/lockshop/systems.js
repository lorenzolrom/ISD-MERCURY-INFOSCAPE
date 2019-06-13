function getForm()
{
    let name = $('#name').val();
    let code = $('#code').val();

    return {
        name: name,
        code: code
    }
}

function search()
{
    apiRequest('POST', 'lockshop/systems/search', getForm()).done(function(json){
        let refs = [];
        let rows = [];

        $.each(json.data, function(i,v){
            refs.push(v.id);

            rows.push([
                v.name,
                v.code
            ])
        });

        setupTable({
            target: 'results',
            header: ['Code', 'Name'],
            linkColumn: 0,
            sortColumn: 0,
            sortMethod: 'asc',
            href: baseURI + 'lockshop/systems/',
            rows: rows,
            refs: refs
        });

        setSearchCookie('lockSystemSearch', getForm());
        unveil();
    });

    return false;
}

function create(){}

function update(id){}

function remove(id){}
let coresLoaded = false;
let keysLoaded = false;

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
                v.code,
                v.name
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

function create(){
    apiRequest('POST', 'lockshop/systems', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'lockshop/systems/' + json.data.id  + '?SUCCESS=System created');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function update(id)
{
    apiRequest('PUT', 'lockshop/systems/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'lockshop/systems/' + id + '?SUCCESS=System updated');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function remove(id)
{
    apiRequest('DELETE', 'lockshop/systems/' + id, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'lockshop/systems?SUCCESS=System deleted');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function loadCores(id)
{
    if(coresLoaded)
        return;

    apiRequest('GET', 'lockshop/systems/' + id + '/cores', {}).done(function(json){
        if(json.code === 200)
        {
            let refs = [];
            let rows = [];
            $.each(json.data, function(i, v){
                refs.push(v.id);

                rows.push([
                    v.code,
                    v.quantity
                ]);
            });

            setupTable({
                target: 'lock-region',
                header: ['Code', 'Quantity'],
                sortColumn: 0,
                sortMethod: 'asc',
                href: baseURI + 'lockshop/cores/',
                linkColumn: 0,
                refs: refs,
                rows: rows
            });

            coresLoaded = true;
        }
        else
            showNotifications('error', ['Could not load cores'])
    });
}

function loadKeys(id)
{
    if(keysLoaded)
        return;

    apiRequest('GET', 'lockshop/systems/' + id + '/keys', {}).done(function(json){
        if(json.code === 200)
        {
            let refs = [];
            let rows = [];
            $.each(json.data, function(i, v){
                refs.push(v.id);

                rows.push([
                    v.code,
                    v.quantity
                ]);
            });

            setupTable({
                target: 'key-region',
                header: ['Code', 'Quantity'],
                sortColumn: 0,
                sortMethod: 'asc',
                href: baseURI + 'lockshop/keys/',
                linkColumn: 0,
                refs: refs,
                rows: rows
            });

            keysLoaded = true;
        }
        else
            showNotifications('error', ['Could not load keys'])
    });
}

function createCore(id)
{
    let code = $('#coreCode').val();
    let quantity = $('#coreQuantity').val();

    apiRequest('POST', 'lockshop/cores/' + id, {
        code: code,
        quantity: quantity
    }).done(function(json){
        if(json.code === 201)
        {
            showNotifications('success', ['Core created']);
            coresLoaded = false;
            loadCores(id);
        }
        else
            showNotifications('error', json.data.errors)
    });

    return false;
}

function createKey(id)
{
    let code = $('#keyCode').val();
    let quantity = $('#keyQuantity').val();
    let keyway = $('#keyKeyway').val();
    let bitting = $('#keyBitting').val();

    apiRequest('POST', 'lockshop/keys/' + id, {
        code: code,
        quantity: quantity,
        keyway: keyway,
        bitting: bitting
    }).done(function(json){
        if(json.code === 201)
        {
            showNotifications('success', ['Key created']);
            keysLoaded = false;
            loadKeys(id);
        }
        else
            showNotifications('error', json.data.errors)
    });

    return false;
}

$(document).ready(function(){
    if(document.getElementById("results"))
        restoreSearch('lockSystemSearch', search);
});
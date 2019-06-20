function getSearchForm()
{
    let number = $('#number').val();
    let startDate = $('#startDate').val();
    let endDate = $('#endDate').val();
    let approved = $('#approved').val();
    let fulfilled = $('#fulfilled').val();
    let canceled = $('#canceled').val();

    return {
        number: number,
        startDate: startDate,
        endDate: endDate,
        approved: approved,
        fulfilled: fulfilled,
        canceled: canceled
    };
}

function getEditForm()
{
    let notes = $('#notes').val();

    return {
        notes: notes
    };
}

function getAssetForm()
{
    let assetTag = $('#assetTag').val();

    return {
        assetTag: assetTag
    };
}

function search()
{
    apiRequest('POST', 'discardorders/search', getSearchForm()).done(function(json){
        let refs = [];
        let rows = [];

        $.each(json.data, function(i, v){
            refs.push(v.number);

            let status = 'Created';

            if(v.approved)
                status = 'Approved';
            if(v.fulfilled)
                status = 'Fulfilled';
            else if(v.canceled)
                status = 'Canceled';

            rows.push([
                v.number,
                v.date,
                status
            ]);
        });

        setupTable({
            target: 'results',
            header: ['Number', 'Date', 'Status'],
            href: baseURI + 'inventory/discards/',
            linkColumn: 0,
            sortColumn: 0,
            refs: refs,
            rows: rows
        });

        setSearchCookie('discardSearch', getSearchForm());
        unveil();
    });

    return false;
}

function loadAssets(number)
{
    apiRequest('GET', 'discardorders/' + number + '/assets', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.assetTag);

            rows.push([
                v.assetTag,
                v.serialNumber,
                'REMOVE'
            ]);
        });

        setupTable({
            target: 'asset-region',
            header: ['Asset #', 'Serial Number', ''],
            href: "javascript: removeAsset('" + number + "', '{{%}}')",
            usePlaceholder: true,
            linkColumn: 2,
            rows: rows,
            refs: refs
        });
    });
}

function addAsset(number)
{
    apiRequest('POST', 'discardorders/' + number + '/assets', getAssetForm()).done(function(json){
        if(json.code === 204)
        {
            loadAssets(number);
            showNotifications('success', ['Asset added']);
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function removeAsset(number, asset)
{
    apiRequest('DELETE', 'discardorders/' + number + '/assets/' + asset, {}).done(function(json){
        if(json.code === 204)
        {
            loadAssets(number);
            showNotifications('success', ['Asset removed']);
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function create()
{
    apiRequest('POST', 'discardorders', getEditForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'inventory/discards/' + json.data.id + '?NOTICE=Discard Order created');
        else
        {
            showNotifications('error', json.data.errors);
            unveil();
        }
    });

    return false;
}

function save(number)
{
    apiRequest('PUT', 'discardorders/' + number, getEditForm()).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + 'inventory/discards/' + number + '?NOTICE=Discard Order updated');
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });
}

function approve(number)
{
    apiRequest('PUT', 'discardorders/' + number + '/approve', {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "inventory/discards/" + number + "?NOTICE=Discard Order has been approved");
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function fulfill(number)
{
    apiRequest('PUT', 'discardorders/' + number + '/fulfill', {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "inventory/discards/" + number + "?NOTICE=Discard Order has been fulfilled");
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

function cancel(number)
{
    apiRequest('PUT', 'discardorders/' + number + '/cancel', {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace (baseURI + "inventory/discards/" + number + "?NOTICE=Discard Order has been canceled");
        }
        else
        {
            showNotifications('error', json.data.errors);
        }
    });

    return false;
}

$(document).ready(function(){
    if(document.getElementById("results"))
        restoreSearch('purchaseOrderSearch', search);
    else if(document.getElementById("do-display"))
    {
        let edit = $('#edit-button');
        let add = $('#addAsset-button');
        let approve = $('#approve');
        let fulfill = $('#fulfill');
        let cancel = $('#cancel');

        if($('#approveDate').text().length > 0)
        {
            $(add).hide();
            $(approve).hide();
        }
        else
        {
            $(fulfill).hide();
        }

        if($('#cancelDate').text().length > 0)
        {
            $(add).hide();
            $(approve).hide();
            $(fulfill).hide();
            $(cancel).hide();
        }

        if($('#fulfillDate').text().length > 0)
        {
            $(fulfill).hide();
            $(cancel).hide();
        }
    }
});
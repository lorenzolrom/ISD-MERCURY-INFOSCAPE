function getSearchForm()
{
    let systemCode = document.getElementById('systemCode').value;
    let stamp = document.getElementById('stamp').value;
    let type = document.getElementById('type').value;
    let keyway = document.getElementById('keyway').value;
    let notes = document.getElementById('notes').value;

    return {
        systemCode: systemCode,
        stamp: stamp,
        type: type,
        keyway: keyway,
        notes: notes
    };
}

function getForm()
{
    let systemCode = document.getElementById('systemCode').value;
    let stamp = document.getElementById('stamp').value;
    let type = document.getElementById('type').value;
    let keyway = document.getElementById('keyway').value;
    let notes = document.getElementById('notes').value;

    let pinTable = document.getElementById('pinTable');
    let pins = pinTable.getElementsByTagName('input');

    let numRows = pins.length / 7;

    let pinArray = [];

    for(let i = 0; i < numRows; i++)
    {
        pinArray.push([]);
    }

    $.each(pins, function(i, e){
        let pinPositionParts = e.name.split('_');
        let row = pinPositionParts[1];
        pinArray[row].push(e.value);
    });

    let pinDataString = '';

    $.each(pinArray, function(i, e){
        pinDataString += e.join(',') + '|';
    });

    pinDataString = pinDataString.substr(0, pinDataString.length - 1); // Remove trailing |

    return {
        systemCode: systemCode,
        stamp: stamp,
        pinData: pinDataString,
        type: type,
        keyway: keyway,
        notes: notes
    };
}

function search()
{
    apiRequest('POST', 'lockcores/search', getSearchForm()).done(function(json){

        if(json.code === 200)
        {
            let refs = [];
            let rows = [];

            $.each(json.data, function(i, v){
                refs.push(v.id);

                rows.push([
                    v.systemCode,
                    v.stamp,
                    v.type,
                    v.keyway
                ]);
            });

            $('#results').mlTable({
                refs: refs,
                rows: rows,
                sortColumn: 0,
                sortMethod: 'asc',
                header: ['System', 'Stamp', 'Type', 'Keyway'],
                linkColumn: 1,
                href: baseURI + 'cliff/cores/'
            });
        }

        setSearchCookie('cliffcoresearch', getSearchForm());
        unveil();
    });

    return false;
}

function create()
{
    apiRequest('POST', 'lockcores', getForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'cliff/cores?SUCCESS=Core created');
    });

    return false;
}

function update(id)
{
    apiRequest('PUT', 'lockcores/' + id, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'cliff/cores?SUCCESS=Core updated');
    });

    return false;
}

function del(id)
{
    apiRequest('DELETE', 'lockcores/' + id, []).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'cliff/cores?SUCCESS=Core deleted');
    });
}

/**
 * If a search cookie is set, re-run the search
 */
function restoreSearch()
{
    if(!document.getElementById("results"))
        return;

    let last =  getCookie('cliffcoresearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $('#stamp').val(last.stamp);
        $('#systemCode').val(last.systemCode);
        $('#keyway').val(last.keyway);
        $('#type').val(last.type);
        $('#notes').val(last.notes);
        search();
    }
}

$(document).ready(function(){
    restoreSearch();
});
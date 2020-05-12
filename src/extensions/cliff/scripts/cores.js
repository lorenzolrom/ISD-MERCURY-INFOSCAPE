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

function readCore(id)
{
    veil();

    apiRequest('GET', 'lockprocess/read/' + id, []).done(function(json){
        if(json.code !== 200)
        {
            unveil();
            return;
        }

        let display = document.getElementById('readCoreResults');
        $(display).html('');

        let data = json.data;

        // Display Control Key
        let control = document.createElement("p");
        control.id = 'readCoreControlDisplay';
        let controlLabel = document.createElement('span');
        controlLabel.appendChild(document.createTextNode("Control: "));
        control.appendChild(controlLabel);

        if(data.control.key !== null)
        {
            let controlLink = document.createElement('a');
            controlLink.target = "_blank";
            controlLink.appendChild(document.createTextNode(data.control.bitting + " (" + data.control.key.stamp + ")"));
            controlLink.href = baseURI + 'cliff/keys/' + data.control.key.id;
            control.appendChild(controlLink);
        }
        else
        {
            control.appendChild(document.createTextNode(data.control.bitting));
        }

        display.appendChild(control);

        // Display Operating Keys
        let operatingLabel = document.createElement('p');
        operatingLabel.id = 'readCoreOperatingLabel';
        operatingLabel.appendChild(document.createTextNode('There are ' + data.operating.length + ' operating keys'));
        display.appendChild(operatingLabel);

        let operatingList = document.createElement('ul');
        operatingList.id = 'readCoreOperatingList';

        $.each(data.operating, function(i, e){
            let key = document.createElement('li');

            if(e.key !== null)
            {
                let link = document.createElement('a');
                link.appendChild(document.createTextNode(e.bitting + " (" + e.key.stamp + ")"));
                link.href = baseURI + 'cliff/keys/' + e.key.id;
                link.target = "_blank";
                key.appendChild(link);
            }
            else
            {
                key.appendChild(document.createTextNode(e.bitting));
            }

            operatingList.appendChild(key);
        });

        display.appendChild(operatingList);

        $(display).dialog().dialog('option', {
            minWidth: 300,
            height: 600
        });

        unveil();
    });
}
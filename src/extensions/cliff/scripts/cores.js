let locationsLoaded = false;

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

function loadLocations(id, override = false)
{
    let issueRegion = document.getElementById('locations-region');

    if(locationsLoaded && !override)
        return;

    apiRequest('GET', 'lockcores/' + id + '/locations', {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.building,
                v.location,
                v.notes
            ]);
        });

        $(issueRegion).mlTable({
            refs: refs,
            rows: rows,
            sortColumn: 0,
            sortMethod: 'asc',
            header: ['Building', 'Location', 'Notes'],
            linkColumn: 1,
            href: "javascript: popupEditLocation('{{%}}')",
            usePlaceholder: true
        });

        locationsLoaded = true;
    });
}

function popupEditLocation(id)
{
    let editLocationBuilding = document.getElementById('editLocationBuilding');
    let editLocationLocation = document.getElementById('editLocationLocation');
    let editLocationNotes = document.getElementById('editLocationNotes');
    let delLocationButton = document.getElementById('delLocationButton');
    let editLocationForm = document.getElementById('editLocationForm');

    apiRequest('GET', 'lockcores/' + coreId + '/locations/' + id, []).done(function(json){
        if(json.code !== 200)
            return;

        editLocationBuilding.value = json.data.building;
        editLocationLocation.value = json.data.location;
        editLocationNotes.value = json.data.notes;
        delLocationButton.onclick = function(){
            delLocation(json.data.id);
        };

        editLocationForm.onsubmit = function(){
            updateLocation(json.data.id);
            return false;
        };

        let dialog = document.getElementById('editLocation-dialog');
        $(dialog).dialog().dialog("option", {
            position: {
                my: 'top',
                at: 'right',
                of: event
            }
        });
    });
}

function createLocation(id)
{
    let building = document.getElementById('assignLocationBuilding').value;
    let location = document.getElementById('assignLocationLocation').value;
    let notes = document.getElementById('assignLocationNotes').value;

    apiRequest('POST', 'lockcores/' + id + '/locations', {
        building: building,
        location: location,
        notes: notes
    }).done(function(json){
        if(json.code === 201)
        {
            showNotifications('success', ['Location assigned']);

            if(locationsLoaded)
                loadLocations(id, true); // Force re-load of issues if already loaded
        }

        unveil();
    });

    return false;
}

function updateLocation(id)
{
    let building = document.getElementById('editLocationBuilding').value;
    let location = document.getElementById('editLocationLocation').value;
    let notes = document.getElementById('editLocationNotes').value;

    apiRequest('PUT', 'lockcores/' + coreId + '/locations/' + id, {
        building: building,
        location: location,
        notes: notes
    }).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Location updated']);
            if(locationsLoaded)
                loadLocations(coreId, true);
        }
        unveil();
    });
}

function delLocation(id)
{
    apiRequest('DELETE', 'lockcores/' + coreId + '/locations/' + id, []).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Location deleted']);
            if(locationsLoaded)
                loadLocations(coreId, true);

            $('#editLocation-dialog').dialog('close');
        }

        unveil();
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
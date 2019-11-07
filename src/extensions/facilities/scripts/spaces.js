let spacesShown = true;
let labelsShown = true;
let floorId = null; // This will be set on the initial load of the page


/**
 * Hides/shows colored spaces
 */
function toggleSpaces()
{
    let button = document.getElementById('spacesButton');
    button.removeChild(button.childNodes[1]);

    let spaceArea = document.getElementById('spaceArea'); // SVG element for spaces

    if(spacesShown)
    {
        button.appendChild(document.createTextNode('Show Spaces'));
        spacesShown = false;
        spaceArea.style.display = "none";
    }
    else
    {
        button.appendChild(document.createTextNode('Hide Spaces'));
        spacesShown = true;
        spaceArea.style.display = "inline-block";
    }
}

/**
 * Hide/show space labels
 */
function toggleLabels()
{
    let button = document.getElementById('labelButton');
    button.removeChild(button.childNodes[1]);

    if(labelsShown)
    {
        button.appendChild(document.createTextNode('Show Labels'));
        labelsShown = false;
        $('.spaceLabel').hide();
    }
    else
    {
        button.appendChild(document.createTextNode('Hide Labels'));
        labelsShown = true;
        $('.spaceLabel').show();
    }
}

/**
 * Loads spaces for this floor and renders them as polylines
 * @param id Floor ID
 */
function loadSpaces(id)
{
    floorId = id;
    // Make div#floorplanArea the same height as img#floorplanImage
    let floorplanArea = document.getElementById('floorplanArea'); // Container of floorplanImage and spaceArea
    let floorplanImage = document.getElementById('floorplanImage'); // Image of floor
    let spaceArea = document.getElementById('spaceArea'); // SVG element for spaces
    let height = floorplanImage.height;
    let width = floorplanImage.width;

    floorplanArea.style.height = height + 'px';
    spaceArea.style.height = height + 'px';
    spaceArea.style.width = width + 'px';

    // Remove everything currently in SVG
    while(spaceArea.firstChild)
    {
        spaceArea.removeChild(spaceArea.firstChild);
    }

    // Remove any labels
    $('.spaceLabel').remove();

    let svgns = 'http://www.w3.org/2000/svg';

    // Load spaces
    apiRequest('GET', 'spaces/floor/' + id, {}).done(function(json){
        $.each(json.data, function(i, v){
            if(v.points.length === 0) // If no points, skip
                return;

            let group = document.createElementNS(svgns, 'g');

            let polyline = document.createElementNS(svgns, 'polyline');
            polyline.setAttributeNS(null, 'fill', '#' + v.hexColor);
            polyline.setAttributeNS(null, 'stroke', 0);
            polyline.setAttributeNS(null, 'opacity', '75%');

            polyline.id = 'space_' + v.location; // Add ID
            polyline.classList.add('space'); // Add class

            polyline.addEventListener('click', function(){inspectSpace(v.location)}); // Add listener to inspect this space

            let points = [];

            let sumX = 0;
            let sumY = 0;
            let count = 0;

            for(let key in v.points) // Point is the point ID
            {
                let x = width * (v.points[key].pR / 100.0);
                let y = height * (v.points[key].pD / 100.0);

                sumX += x;
                sumY += y;
                count ++;

                points.push([x, y]);
            }

            let pointString = '';

            for(let i = 0; i < points.length; i++)
            {
                pointString += points[i][0] + ',' + points[i][1] + ' ';
            }

            // Add 'points' attribute to polyline
            polyline.setAttributeNS(null, 'points', pointString);

            // Add polyline to spaceArea
            group.appendChild(polyline);
            spaceArea.appendChild(group);

            // Create code label
            let label = document.createElement('div');
            label.classList.add('spaceLabel');
            label.style.top = (sumY / count) - 30 + 'px';
            label.style.left = (sumX / count) - 20 + 'px';

            let code = document.createElement('span');
            code.appendChild(document.createTextNode(v.code));

            let name = document.createElement('p');
            name.appendChild(document.createTextNode(v.name));

            label.appendChild(code);
            label.appendChild(name);

            label.addEventListener('click', function(){inspectSpace(v.location)}); // Add listener to inspect this space

            floorplanArea.appendChild(label);
        });
    });
}

/**
 * Create a space
 * @param id
 */
function defineSpace(id)
{
    let buildingCode = document.getElementById('defineBuildingCode').innerHTML;
    let locationCode = document.getElementById('defineLocationCode').value;
    let hexColor = document.getElementById('defineHexColor').value;
    let area = document.getElementById('defineArea').value;
    let unit = document.getElementById('defineUnit').value;

    // Remove trailing or leading new line, and split into array by contained new lines
    let points = document.getElementById('defineSpacePoints').value.replace(/^\s+|\s+$/g, '').split(/\r?\n/);

    let floorplanImage = document.getElementById('floorplanImage'); // Image of floor
    let height = floorplanImage.height;
    let width = floorplanImage.width;

    let convertedPoints = [];

    // Convert points to percentages
    for(let i = 0; i < points.length; i++)
    {
        let parts = points[i].split(',');
        let orgX = parts[0];
        let orgY = parts[1];

        let pR = (orgX / width) * 100.0;
        let pD = (orgY / height) * 100.0;

        convertedPoints.push([pD, pR]);
    }

    apiRequest('POST', 'spaces', {
        buildingCode: buildingCode,
        locationCode: locationCode,
        floor: id,
        points: convertedPoints,
        hexColor: hexColor,
        area: area,
        unit: unit
    }).done(function(json){
        if(json.code === 201)
        {
            showNotifications('success', ['Space defined']);
            loadSpaces(id);
            cancelDefine();
        }
    });

    return false;
}

/**
 * Re-defines a space
 * @param id
 */
function redefineSpace(id)
{
    // Remove trailing or leading new line, and split into array by contained new lines
    let points = document.getElementById('redefineSpacePoints').value.replace(/^\s+|\s+$/g, '').split(/\r?\n/);

    let floorplanImage = document.getElementById('floorplanImage'); // Image of floor
    let height = floorplanImage.height;
    let width = floorplanImage.width;

    let convertedPoints = [];

    // Convert points to percentages
    for(let i = 0; i < points.length; i++)
    {
        let parts = points[i].split(',');
        let orgX = parts[0];
        let orgY = parts[1];

        let pR = (orgX / width) * 100.0;
        let pD = (orgY / height) * 100.0;

        convertedPoints.push([pD, pR]);
    }

    apiRequest('PUT', 'spaces/' + id + '/points', {
        points: convertedPoints,
    }).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Space re-defined']);
            loadSpaces(floorId);
            cancelRedefine();
        }
    });
}

/**
 * Begin listening to clicks on the floorplan image and add those points to the textarea in #defineSpacePoints
 */
function listenPoints()
{
    let spaceArea = document.getElementById('spaceArea');
    spaceArea.classList.add('selectPoints');

    spaceArea.addEventListener('click', addSpacePoint);
}

/**
 * Add clicked on point to the point list
 * @param event Mouse click
 */
function addSpacePoint(event)
{
    let spaceArea = document.getElementById('spaceArea');
    let defineSpacePoints = document.getElementById('defineSpacePoints');
    let rect = spaceArea.getBoundingClientRect();
    let x = event.clientX - rect.left;
    let y = event.clientY - rect.top;

    defineSpacePoints.appendChild(document.createTextNode(x + ',' + y));
    defineSpacePoints.innerHTML = defineSpacePoints.innerHTML + '\n'; // Add new line
}

/**
 * Clears all point input and prevents points from being added
 */
function cancelDefine()
{
    let spaceArea = document.getElementById('spaceArea');
    let dialog = document.getElementById('defineSpace-dialog');

    document.getElementById('defineSpaceForm').reset();
    document.getElementById('defineSpacePoints').innerText = '';



    // remove selectPoints class from spaceArea
    spaceArea.classList.remove('selectPoints');

    // remove onclick event
    spaceArea.removeEventListener('click', addSpacePoint);

    // close modal
    $(dialog).dialog('close');
}

/**
 * Cancel re-define of space
 */
function cancelRedefine()
{
    let dialog = document.getElementById('redefineSpace-dialog');
    $(dialog).dialog('close');
}

/**
 * Create a dialog for viewing a space
 * @param id Space ID
 */
function inspectSpace(id)
{
    let inspectLocationCode = document.getElementById('inspectLocationCode');
    let inspectLocationName = document.getElementById('inspectLocationName');
    let inspectHexColor = document.getElementById('inspectHexColor');
    let inspectArea = document.getElementById('inspectArea');
    let inspectUnit = document.getElementById('inspectUnit');
    let goToLocationLink = document.getElementById('goToLocationLink');
    let editSpaceButton = document.getElementById('editSpace');
    let deleteButton = document.getElementById('deleteSpace');
    let redefineSpace = document.getElementById('redefineSpace');

    // Remove existing event listeners
    $(editSpaceButton).unbind();

    apiRequest('GET', 'spaces/' + id, {}).done(function(json){
        if(json.code === 200)
        {
            inspectLocationCode.value = json.data.code;
            inspectLocationName.value = json.data.name;
            inspectHexColor.value = json.data.hexColor;
            inspectArea.value = json.data.area;
            inspectUnit.value = json.data.unit;
            goToLocationLink.href = baseURI + 'facilities/locations/' + json.data.location;

            //Add edit and delete button scripts
            editSpaceButton.href = "javascript: openSpaceEditDialog('" + id + "')";
            redefineSpace.href = "javascript: openSpaceRedefineDialog('" + id + "')";
            deleteButton.href = "javascript: deleteSpace('" + id + "')";

            $('#inspectSpace-dialog').dialog();
        }
    });
}

/**
 * Switch from inspect dialog to edit dialog
 * @param id ID of space to edit
 */
function openSpaceEditDialog(id)
{
    // Transfer attributes to edit form
    let inspectLocationCode = document.getElementById('inspectLocationCode');
    let inspectLocationName = document.getElementById('inspectLocationName');
    let inspectHexColor = document.getElementById('inspectHexColor');
    let inspectArea = document.getElementById('inspectArea');
    let inspectUnit = document.getElementById('inspectUnit');

    let editLocationCode = document.getElementById('editLocationCode');
    let editLocationName = document.getElementById('editLocationName');
    let editHexColor = document.getElementById('editHexColor');
    let editArea = document.getElementById('editArea');
    let editUnit = document.getElementById('editUnit');

    editLocationCode.value = inspectLocationCode.value;
    editLocationName.value = inspectLocationName.value;
    editHexColor.value = inspectHexColor.value;
    editArea.value = inspectArea.value;
    editUnit.value = inspectUnit.value;

    // Add button event listeners
    let saveButton = document.getElementById('saveSpace');
    let cancelButton = document.getElementById('cancelSave');
    let editSpaceDialog = document.getElementById('editSpace-dialog');

    // Assign save button operation
    saveButton.href = "javascript: editSpace('" + id + "')";

    // Close inspect and open edit
    $('#inspectSpace-dialog').dialog('close');
    $(editSpaceDialog).dialog();
}

function openSpaceRedefineDialog(id)
{
    // Fill in values from inspect and set up buttons
    let redefineSpaceDialog = document.getElementById('redefineSpace-dialog');

    let inspectLocationCode = document.getElementById('inspectLocationCode');
    let inspectLocationName = document.getElementById('inspectLocationName');

    let redefineLocationCode = document.getElementById('redefineLocationCode');
    let redefineLocationName = document.getElementById('redefineLocationName');

    let saveButton = document.getElementById('saveRedefine');

    redefineLocationCode.value = inspectLocationCode.value;
    redefineLocationName.value = inspectLocationName.value;
    saveButton.href = "javascript: redefineSpace('" + id + "')";

    // Import existing points
    let polyLine = document.getElementById('space_' + id);
    let points = polyLine.points; // Raw SVG points from polyline
    let pointArray = []; // Converted points to array

    let pointBox = document.getElementById('redefineSpacePoints');
    pointBox.innerHTML = '';

    for(let i = 0; i < points.length; i++)
    {
        pointBox.appendChild(document.createTextNode(points[i].x + ',' + points[i].y));
        pointBox.innerHTML = pointBox.innerHTML + '\n'; // Add new line
    }

    $('#inspectSpace-dialog').dialog('close');
    $(redefineSpaceDialog).dialog();
}

/**
 * Save changed to space
 * @param id ID of space to edit
 */
function editSpace(id)
{
    let editHexColor = document.getElementById('editHexColor');
    let editArea = document.getElementById('editArea');
    let editUnit = document.getElementById('editUnit');

    apiRequest('PUT', 'spaces/' + id, {
        hexColor: editHexColor.value,
        area: editArea.value,
        unit: editUnit.value
    }).done(function(json){
        if(json.code === 204)
        {
            loadSpaces(floorId); // Force re-load of spaces
            showNotifications('success', ['Space updated']);
            $('#editSpace-dialog').dialog('close');
        }
    });
}

/**
 * Close the provided tag ID
 * @param id
 */
function closeDialog(id)
{
    $('#' + id).dialog('close');
}

/**
 * Delete a space
 * @param id
 */
function deleteSpace(id)
{
    apiRequest('DELETE', 'spaces/' + id, {}).done(function(json){
        if(json.code === 204)
        {
            loadSpaces(floorId); // Force re-load of spaces
            showNotifications('success', ['Space deleted']);
            $('#inspectSpace-dialog').dialog('close');
        }
    });
}
let spacesShown = true;

function getForm()
{
    let buildingCode = document.getElementById('buildingCode').value;
    let floor = document.getElementById('floor').value;

    return {
        buildingCode: buildingCode,
        floor: floor
    };
}

function search()
{
    apiRequest('POST', 'floorplans/search', getForm()).done(function(json){
        if(json.code === 200)
        {
            let refs = [];
            let rows = [];

            $.each(json.data, function(i, v){
                refs.push(v.id);
                rows.push([
                    v.buildingCode,
                    v.buildingName,
                    v.floor
                ]);
            });

            $('#results').mlTable({
                refs: refs,
                rows: rows,
                sortColumn: 0,
                sortMethod: 'asc',
                header: ['Building Code', 'Building Name', 'Floor'],
                linkColumn: 0,
                href: baseURI + 'facilities/floorplans/'
            });
        }

        setSearchCookie('floorplanSearch', getForm());

        unveil();
    });

    return false;
}

function update(id)
{
    let floor = document.getElementById('floor').value;

    apiRequest('PUT', 'floorplans/' + id, {floor:floor}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + "facilities/floorplans/" + id + "?SUCCESS=Floorplan updated");
        }
    });

    return false;
}

function del(id)
{
    apiRequest('DELETE', 'floorplans/' + id, {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + "facilities/floorplans?SUCCESS=Floorplan deleted");
        }
    });

    return false;
}

function toggleSpaces(floorId)
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

function restoreSearch()
{
    if(!document.getElementById("results"))
        return;

    let last =  getCookie('floorplanSearch');

    if(last !== "")
    {
        veil();

        last = JSON.parse(window.atob(last));
        $('#buildingCode').val(last.buildingCode);
        $('#floor').val(last.floor);
        search();
    }
}

/**
 * Loads spaces for this floor and renders them as polylines
 * @param id
 */
function loadSpaces(id)
{
    // Make div#floorplanArea the same height as img#floorplanImage
    let floorplanArea = document.getElementById('floorplanArea'); // Container of floorplanImage and spaceArea
    let floorplanImage = document.getElementById('floorplanImage'); // Image of floor
    let spaceArea = document.getElementById('spaceArea'); // SVG element for spaces
    let height = floorplanImage.height;
    let width = floorplanImage.width;

    // Remove everything currently in SVG
    while(spaceArea.firstChild)
    {
        spaceArea.removeChild(spaceArea.firstChild);
    }

    floorplanArea.style.height = height + 'px';
    spaceArea.style.height = height + 'px';
    spaceArea.style.width = width + 'px';

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

            floorplanArea.appendChild(label);
        });
    });
}

/**
 * Add clicked on point to the point list
 * @param event
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
 * Begin listening to clicks on the floorplan image and add those points to the textarea in #defineSpacePoints
 */
function listenPoints()
{
    let spaceArea = document.getElementById('spaceArea');
    spaceArea.classList.add('selectPoints');

    spaceArea.addEventListener('click', addSpacePoint);
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
        console.log(json);
        if(json.code === 201)
        {
            loadSpaces(id);
            cancelDefine();
        }
    });

    return false;
}

$(document).ready(function(){
    restoreSearch();
});
/**
 * Return the search form
 * @returns {{buildingCode: *, floor: *}}
 */
function getForm()
{
    let buildingCode = document.getElementById('buildingCode').value;
    let floor = document.getElementById('floor').value;

    return {
        buildingCode: buildingCode,
        floor: floor
    };
}

/**
 * Search for floorplans
 * @returns {boolean}
 */
function search()
{
    apiRequest('POST', 'floorplans/search', getForm()).done(function(json){
        if(json.code === 200)
        {
            let refs = [];
            let rows = [];

            $.each(json.data, function(i, v){
                refs.push(v.id);

                // Format area
                let areaString = '';

                $.each(v.area, function(j, w){
                    areaString += w + j + ' ';
                });

                rows.push([
                    v.buildingCode,
                    v.buildingName,
                    v.floor,
                    areaString.trim()
                ]);
            });

            $('#results').mlTable({
                refs: refs,
                rows: rows,
                sortColumn: 0,
                sortMethod: 'asc',
                header: ['Building Code', 'Building Name', 'Floor', 'Area'],
                linkColumn: 0,
                href: baseURI + 'facilities/floorplans/'
            });
        }

        setSearchCookie('floorplanSearch', getForm());

        unveil();
    });

    return false;
}

/**
 * Update floorplan
 * @param id
 * @returns {boolean}
 */
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

/**
 * Delete floorplan
 * @param id
 * @returns {boolean}
 */
function del(id)
{
    apiRequest('DELETE', 'floorplans/' + id, {}).done(function(json){
        if(json.code === 204)
        {
            window.location.replace(baseURI + "facilities/floorplans?SUCCESS=Floorplan deleted");
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

$(document).ready(function(){
    restoreSearch();
});
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

$(document).ready(function(){
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
});
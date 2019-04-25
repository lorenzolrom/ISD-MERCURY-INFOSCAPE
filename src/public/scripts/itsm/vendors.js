/**
 * Load current vendors
 */
function loadVendors()
{
    apiRequest("GET", "vendors", {}).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i,v){
            refs.push(v.id);

            rows.push([
                v.code,
                v.name
            ]);
        });

        setupTable({
            target:'results',
            type:'table',
            header: ['Code', 'Name'],
            sortColumn: 0,
            sortMethod: "asc",
            linkColumn: 0,
            href: baseURI + "inventory/vendors/",
            refs: refs,
            rows: rows
        });
    });
}

// If results div is present, load the asset types
if($('#results').length !== 0)
{
    loadVendors();
}
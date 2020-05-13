function xRefPeople()
{
    let issuedTo = document.getElementById('issuedTo').value;
    let results = document.getElementById('results');

    apiRequest('POST', 'lockadvanced/xrefpeople', {
        issuedTo: issuedTo
    }).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.systemCode,
                v.stamp
            ]);
        });

        $(results).mlTable({
            refs: refs,
            rows: rows,
            sortColumn: 0,
            sortMethod: 'asc',
            header: ['System', 'Stamp'],
            linkColumn: 1,
            href: "cliff/keys/",
        });

        unveil();
    });
}

function xRefLocations()
{
    let building = document.getElementById('building').value;
    let location = document.getElementById('location').value;
    let results = document.getElementById('results');

    apiRequest('POST', 'lockadvanced/xreflocations', {
        building: building,
        location: location
    }).done(function(json){
        let rows = [];
        let refs = [];

        $.each(json.data, function(i, v){
            refs.push(v.id);

            rows.push([
                v.systemCode,
                v.stamp
            ]);
        });

        $(results).mlTable({
            refs: refs,
            rows: rows,
            sortColumn: 0,
            sortMethod: 'asc',
            header: ['System', 'Stamp'],
            linkColumn: 1,
            href: "cliff/cores/",
        });

        unveil();
    });
}
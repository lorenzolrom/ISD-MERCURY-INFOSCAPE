function buildCore()
{
    let system = $('#systemCode').val();
    let controlStamp = document.getElementById('controlStamp').value;
    let operatingStamps = document.getElementById('operatingStamps').value;
    let buildToCore = document.getElementById('buildToCore').value;

    let requestType = 'POST'; // Default to building core for data only

    if(buildToCore.length > 0) // If core specified, switch to PUT
        requestType = 'PUT';

    apiRequest(requestType, 'lockprocess/build', {
        systemCode: system,
        controlStamp: controlStamp,
        operatingStamps: operatingStamps,
        buildToCore: buildToCore
    }).done(function(json){
        if(json.code === 200 || json.code === 201) // OK, show results
        {
            let pinTable = document.getElementById('pinTable');
            pinTable.innerHTML = '';

            for(let i = 0; i < json.data.length; i++)
            {
                let tr = document.createElement('tr');

                for(let j = 0; j < json.data[i].length; j++)
                {
                    let value = json.data[i][j];

                    if(value === null)
                        value = '';

                    let td = document.createElement('td');
                    td.appendChild(document.createTextNode(value));
                    tr.appendChild(td);
                }

                pinTable.appendChild(tr);
            }
        }

        if(json.code === 201) // Build to core OK
        {
            showNotifications('success', ['Built to code ' + buildToCore]);
        }

        unveil();
    });
}

function compareCores()
{
    let system = $('#systemCode').val();
    let coreStamps = document.getElementById('coreStamps').value;

    apiRequest('POST', 'lockprocess/compare', {
        systemCode: system,
        coreStamps: coreStamps
    }).done(function(json){

        if(json.code !== 200)
        {
            unveil();
            return;
        }

        let label = document.getElementById("compareLabel");
        label.innerHTML = '';
        let results = document.getElementById("compareResults");
        results.innerHTML = '';
        let data = json.data;

        label.appendChild(document.createTextNode("Showing " + data.length + " common operating keys:"));

        $.each(data, function(i, e){
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

            results.appendChild(key);
        });
    });

    unveil();
}

function sequenceKeys()
{
    let systemCode = $('#systemCode').val();
    let stamp = document.getElementById('stamp').value;
    let type = document.getElementById('type').value;
    let keyway = document.getElementById('keyway').value;
    let seqStart = document.getElementById('seqStart').value;
    let seqEnd = document.getElementById('seqEnd').value;
    let padding = document.getElementById('padding').value;
    let c1 = document.getElementById('c1').value;
    let c2 = document.getElementById('c2').value;
    let c3 = document.getElementById('c3').value;
    let c4 = document.getElementById('c4').value;
    let c5 = document.getElementById('c5').value;
    let c6 = document.getElementById('c6').value;
    let c7 = document.getElementById('c7').value;

    apiRequest('POST', 'lockprocess/sequence', {
        systemCode: systemCode,
        stamp: stamp,
        type: type,
        keyway: keyway,
        seqStart: seqStart,
        seqEnd: seqEnd,
        padding: padding,
        c1: c1,
        c2: c2,
        c3: c3,
        c4: c4,
        c5: c5,
        c6: c6,
        c7: c7
    }).done(function(json){
        if(json.code === 201)
        {
            showNotifications('success', ['Created ' + json.data.count + ' keys']);
        }

        unveil();
    });
}


function loadSystems()
{
    let systemSelect = document.getElementById('systemCode');
    apiRequest('GET', 'locksystems', []).done(function(json){
        if(json.code === 200)
        {
            $.each(json.data, function(i, e){
                let option = document.createElement('option');
                option.value = e.code;
                option.appendChild(document.createTextNode(e.code + " - " + e.name));
                systemSelect.appendChild(option);
            });
        }
        else
            showNotifications('error', ['Could not load Systems'])
    });
}

$(document).ready(function(){
    if(document.getElementById('systemCode')) // If there is a systemCode select present
        loadSystems();
});

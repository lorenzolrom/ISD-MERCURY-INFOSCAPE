function search()
{
    let username = document.getElementById('samaccountname').value;

    apiRequest('GET', 'netuserman/' + username, {}).done(function(json){

        if(json.code === 200)
        {
            window.location.replace(baseURI + 'netuserman/view/' + json.data.samaccountname);
        }

    });

    return false;
}
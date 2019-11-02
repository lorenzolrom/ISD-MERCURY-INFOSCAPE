function getForm()
{
    let givenname = document.getElementById('givenname').value;
    let initials = document.getElementById('initials').value;
    let sn = document.getElementById('sn').value;
    let displayname = document.getElementById('displayname').value;
    let description = document.getElementById('description').value;
    let physicaldeliveryofficename = document.getElementById('physicaldeliveryofficename').value;
    let telephonenumber = document.getElementById('telephonenumber').value;
    let mail = document.getElementById('mail').value;
    let userprincipalname = document.getElementById('userprincipalname').value;
    let title = document.getElementById('title').value;
    let useraccountcontrolSelect = document.getElementById('useraccountcontrol');
    let useraccountcontrol = useraccountcontrolSelect.options[useraccountcontrolSelect.selectedIndex].value;


    return {
        givenname: givenname,
        initials: initials,
        sn: sn,
        displayname: displayname,
        description: description,
        physicaldeliveryofficename: physicaldeliveryofficename,
        telephonenumber: telephonenumber,
        mail: mail,
        userprincipalname: userprincipalname,
        title: title,
        useraccountcontrol: useraccountcontrol
    };
}

function getSearchForm()
{
    let givenname = document.getElementById('givenname').value;
    let sn = document.getElementById('sn').value;
    let samaccountname = document.getElementById('loginname').value;

    return {
        givenname: givenname,
        sn: sn,
        samaccountname: samaccountname
    };
}

/**
 * Query all LDAP users
 * @returns {boolean}
 */
function search()
{
    apiRequest('POST', 'netuserman/search', getSearchForm()).done(function(json){
        if(json.code === 200)
        {
            let rows = [];
            let refs = [];

            $.each(json.data, function(i, v){
                refs.push(v.userprincipalname.split('@')[0]);
                rows.push([
                    v.userprincipalname,
                    v.givenname,
                    v.sn
                ]);
            });

            $('#results').mlTable({
                header: ['Login Name', 'Given Name', 'Surname'],
                linkColumn: 0,
                href: baseURI + 'netuserman/view/',
                refs: refs,
                rows: rows
            });
        }

        unveil();
    });

    return false;
}

/**
 * Find an exact match SAM Account Name and redirect to it
 * Or display an error when 404 is received
 * @returns {boolean}
 */
function getUsername()
{
    let username = document.getElementById('samaccountname').value;

    apiRequest('GET', 'netuserman/' + username, {}).done(function(json){

        if(json.code === 200)
        {
            window.location.replace(baseURI + 'netuserman/view/' + json.data.userprincipalname.split('@')[0]);
        }

    });

    return false;
}

/**
 * Update user attributes
 * @param username
 * @returns {boolean}
 */
function updateUser(username)
{
    apiRequest('PUT', 'netuserman/' + username, getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'netuserman/view/' + username + '?SUCCESS=User updated');
    });

    return false;
}
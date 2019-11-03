function getForm()
{
    let givenname = document.getElementById('givenname').value;
    let initials = document.getElementById('initials').value;
    let sn = document.getElementById('sn').value;
    let distinguishedname = document.getElementById('distinguishedname').value;
    let displayname = document.getElementById('displayname').value;
    let description = document.getElementById('description').value;
    let physicaldeliveryofficename = document.getElementById('physicaldeliveryofficename').value;
    let telephonenumber = document.getElementById('telephonenumber').value;
    let mail = document.getElementById('mail').value;
    let userprincipalname = document.getElementById('userprincipalname').value;
    let title = document.getElementById('title').value;

    let useraccountcontrolSelect = document.getElementById('useraccountcontrol');
    let useraccountcontrol = $(useraccountcontrolSelect).val();


    return {
        givenname: givenname,
        initials: initials,
        sn: sn,
        distinguishedname: distinguishedname,
        displayname: displayname,
        description: description,
        physicaldeliveryofficename: physicaldeliveryofficename,
        telephonenumber: telephonenumber,
        mail: mail,
        userprincipalname: userprincipalname,
        title: title,
        useraccountcontrol: useraccountcontrol,
    };
}

function getCreateForm()
{
    let password = document.getElementById('password').value;
    let confirm = document.getElementById('confirm').value;

    return $.extend({
        password: password,
        confirm: confirm
    }, getForm());
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

                let useraccountcontrol = v.useraccountcontrol;

                let disabled = '';

                if(useraccountcontrol.includes('ACCOUNTDISABLE'))
                    disabled = '✓';

                refs.push(v.userprincipalname.split('@')[0]);
                rows.push([
                    v.userprincipalname.split('@')[0],
                    v.givenname,
                    v.sn,
                    v.title,
                    v.description,
                    disabled
                ]);
            });

            $('#results').mlTable({
                header: ['Login Name', 'Given Name', 'Surname', 'Title', 'Description', 'Disabled'],
                linkColumn: 0,
                href: baseURI + 'netuserman/view/',
                refs: refs,
                rows: rows,
                sortMethod: 'asc'
            });
        }

        unveil();
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

function resetPassword(username)
{
    veil();
    $('#resetPassword-button-dialog').dialog('close');

    let password = document.getElementById('password').value;
    let confirm = document.getElementById('confirm').value;

    apiRequest('PUT', 'netuserman/' + username + '/password', {
        password: password,
        confirm: confirm
    }).done(function(json){
        if(json.code === 204)
        {
            showNotifications('success', ['Password has been reset']);
        }

        unveil();
    });

    return false;
}

function modifyGroups(username)
{
    veil();

    $('#modGroups-button-dialog').dialog('close');

    let addGroups = document.getElementById('addGroups').value.split(/\n/);
    let remGroups = document.getElementById('removeGroups').value.split(/\n/);

    let data = {
        addGroups: addGroups,
        removeGroups: remGroups
    };

    apiRequest('PUT', 'netuserman/' + username + '/groups', data).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'netuserman/view/' + username + '?SUCCESS=Groups updated');
        else
            unveil();
    });

    return false;
}

function deleteUser(username)
{
    veil();

    apiRequest('DELETE', 'netuserman/' + username, {}).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'netuserman/search?SUCCESS=User deleted');
        else
            unveil();
    });
}

function createUser()
{
    veil();
    apiRequest('POST', 'netuserman', getCreateForm()).done(function(json){
        if(json.code === 201)
            window.location.replace(baseURI + 'netuserman/view/' + json.data.userprincipalname.split('@')[0] + '?SUCCESS=User created');
        else
            unveil();
    });

    return false;
}
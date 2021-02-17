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

            if(json.data.length === 1) // Only one result
            {
                window.location.replace(baseURI + 'netuserman/view/' + json.data[0].cn);
            }

            $.each(json.data, function(i, v){

                let useraccountcontrol = v.useraccountcontrol;

                let disabled = '';

                if(useraccountcontrol.includes('ACCOUNTDISABLE'))
                    disabled = '✓';

                refs.push(v.cn);
                rows.push([
                    v.cn,
                    v.displayname,
                    v.title,
                    v.description,
                    disabled
                ]);
            });

            $('#results').mlTable({
                header: ['Common Name', 'Display Name', 'Title', 'Description', 'Disabled'],
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
 * @param cn
 * @returns {boolean}
 */
function updateUser(cn)
{
    apiRequest('PUT', 'netuserman/' + encodeURI(cn), getForm()).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'netuserman/view/' + cn + '?SUCCESS=User updated');
    });

    return false;
}

function resetPassword(cn)
{
    veil();
    $('#resetPassword-button-dialog').dialog('close');

    let password = document.getElementById('password').value;
    let confirm = document.getElementById('confirm').value;

    apiRequest('PUT', 'netuserman/' + encodeURI(cn) + '/password', {
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

function modifyGroups(cn)
{
    veil();

    $('#modGroups-button-dialog').dialog('close');

    let addGroups = document.getElementById('addGroups').value.split(/\n/);
    let remGroups = document.getElementById('removeGroups').value.split(/\n/);

    let data = {
        addGroups: addGroups,
        removeGroups: remGroups
    };

    apiRequest('PUT', 'netuserman/' + encodeURI(cn) + '/groups', data).done(function(json){
        if(json.code === 204)
            window.location.replace(baseURI + 'netuserman/view/' + cn + '?SUCCESS=Groups updated');
        else
            unveil();
    });

    return false;
}

function deleteUser(cn)
{
    veil();

    apiRequest('DELETE', 'netuserman/' + encodeURI(cn), {}).done(function(json){
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
            window.location.replace(baseURI + 'netuserman/view/' + json.data.cn + '?SUCCESS=User created');
        else
            unveil();
    });

    return false;
}
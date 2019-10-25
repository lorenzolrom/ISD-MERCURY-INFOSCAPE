let activeUsers = [];

/**
 * Requests the list of all users who are currently online
 */
function updateOnlineUsers()
{
    let activeList = document.getElementById('userList');
    let currentList = [];

    apiRequest('GET', 'chat/activeUsers', {}).done(function(json){
        $.each(json.data, function(i, v){
            currentList.push(v.username); // Will be used to check if users are offline

            if(!activeUsers.includes(v.username)) // User already in list, do nothing
            {
                activeUsers.push(v.username);

                let li = document.createElement('li');
                li.id = 'chatUser_' + v.username;

                let span = document.createElement('span');
                span.appendChild(document.createTextNode(v.name + ' (' + v.username + ')'));
                li.appendChild(span);
                activeList.appendChild(li);
            }
        });

        $.each(activeUsers, function(i, v){
            // Check if currentList item is NOT in activeUsers

            if(!currentList.includes(v))
            {
                // find node
                let staleUser = document.getElementById('chatUser_' + v);

                if(staleUser)
                {
                    activeList.removeChild(staleUser);
                    activeUsers.splice(activeUsers.indexOf(v), 1);
                }
            }
        });
    });
}

/**
 * Updates (or creates if this is a new user) the heartbeat time code
 */
function sendHeartbeat()
{
    apiRequest('PUT', 'chat/heartbeat', {});
}

/**
 *
 */
function activeClient()
{
    sendHeartbeat();
    updateOnlineUsers();
}

window.setInterval(function(){
    activeClient();
}, 1000);
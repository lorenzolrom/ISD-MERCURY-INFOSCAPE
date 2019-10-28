// Chat client static elements
let messagePane = document.getElementById('messagePane');
let sendMsgButton = document.getElementById('sendMsgButton');
let messageComposer = document.getElementById('messageComposer');

let activeUsers = []; // List of users active in chat
let seenMessages = []; // Array of message IDs of messages already displayed

/**
 * Requests the list of all users who are currently online
 */
function updateOnlineUsers()
{
    let activeList = document.getElementById('userList');
    let currentList = [];

    apiRequest('GET', 'game/activeUsers', {}).done(function(json){
        $(json.data).each(function(i, v){
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
        }).promise().done(function(){
            $(activeUsers).each(function(i, v){
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
    });
}

/**
 * Updates (or creates if this is a new user) the heartbeat time code
 */
function sendHeartbeat()
{
    apiRequest('PUT', 'game/heartbeat', {});
}

function getMessages(room)
{
    apiRequest('GET', 'game/messages/' + room, {}).done(function(json){
        $.each(json.data, function(i, v){
            if(seenMessages.includes(v.id)) // message already displayed
                return; // skip this iteration

            seenMessages.push(v.id);

            let message = document.createElement('div');

            let time = document.createElement('span');
            time.className += 'time';
            time.appendChild(document.createTextNode(v.time));
            message.appendChild(time);

            let user = document.createElement('span');
            user.className += 'user';
            user.appendChild(document.createTextNode(v.username));
            message.appendChild(user);

            message.appendChild(document.createTextNode(v.message));

            messagePane.appendChild(message);

            messagePane.scrollTop = messagePane.scrollHeight;
        });
    })
}

/**
 * Perform updates to all parts of the chat client
 */
function activeClient()
{
    sendHeartbeat();
    updateOnlineUsers();
    getMessages(0);
}

/**
 * Send a message to the server
 * @param room
 * @param messageBox
 */
function sendMessage(room, messageBox)
{
    if(messageBox.value.length === 0)
        return; // Prevent accidental blank messages, but blank messages are allowed

    apiRequest('POST', 'game/messages', {
        room: room,
        message: messageBox.value
    });

    messageBox.value = "";
}

/**
 * This will return what room the user is in, based on URI or cookie...
 * @returns {number}
 */
function getRoom(){
    return 0;

    // TODO determine what the active room is
    // or return 0 for lobby;
}

/**
 * Repeat update every second
 */
window.setInterval(function(){
    activeClient();
}, 1000);

$(document).ready(function(){
    // Add sendMsgButton listener
    sendMsgButton.addEventListener('click', function(){sendMessage(getRoom(), messageComposer)});

    // Add Enter listener
    messageComposer.addEventListener('keydown', function(event){
        if(event.key === 'Enter')
        {
            sendMessage(getRoom(), messageComposer);
            event.preventDefault(); // Prevent new line in text area
        }
    });
});
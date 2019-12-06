let intervalId = undefined;

// Update the lock status of this ticket
function updateTicketLock(ticket)
{
    apiRequest('PUT', 'tickets/workspaces/' + getWorkspace() + '/tickets/' + ticket + '/lock', {});
}

/**
 * Start the lock update
 */
function startLockUpdate()
{
    intervalId = window.setInterval(function(){updateTicketLock(ticketNumber);}, 1000);
}

/**
 * Pause the lock update
 */
function pauseLockUpdate()
{
    window.clearInterval(intervalId);
    intervalId = undefined;
}

document.addEventListener("DOMContentLoaded", startLockUpdate, false);
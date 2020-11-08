let monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
let weekdayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
let monthDayCount = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; // Will need to add 1 for Feb. on leap years

/**
 * Construct a table calendar inside a div
 *
 * options.year = 4-digit year
 * options.month = 2-digit month
 *
 * @param options
 */
function buildCalendar(options)
{
    let currentDate = new Date();

    // If it is a leap year, change the day count for February to 29
    if(options.year % 4 === 0)
    {
        if(options.year % 100 === 0)
        {
            if(options.year % 400)
            {
                monthDayCount[1] = 29;
            }
        }
        else
        {
            monthDayCount[1] = 29;
        }
    }

    // Holds title and calendar
    let container = document.createElement('div');

    let title = document.createElement('h3');
    title.appendChild(document.createTextNode(monthNames[options.month] + ' ' + options.year));
    title.classList.add('calendarTitle');
    container.appendChild(title);

    let calendar = document.createElement('table');
    calendar.classList.add('calendar');

    // Create week header
    let weekHeader = document.createElement('tr');

    for(let i = 0; i < 7; i++)
    {
        let header = document.createElement('th');
        header.appendChild(document.createTextNode(weekdayNames[i]));
        weekHeader.appendChild(header);
    }

    calendar.appendChild(weekHeader);

    // Get the first day of the week
    let startWeekDay = new Date(options.year, options.month, 1).getDay();

    let days = [];

    // Insert blank days at beginning of first week
    for(let i = 0; i < startWeekDay; i++)
    {
        days.push('');
    }

    // Add actual dates
    for(let i = 0; i < monthDayCount[options.month]; i++)
    {
        days.push(i + 1);
    }

    // Add blank dates at end of last week
    for(let i = days.length; i < 42; i++)
    {
        days.push('');
    }

    for(let i = 0; i < days.length / 7; i++)
    {
        let displayRow = false; // Should row be displayed (only if it has dates)

        let week = document.createElement('tr');

        for(let j = (i * 7); j < (i * 7) + 7; j++)
        {
            let day = document.createElement('td');
            let dayNumber = document.createElement('h3');

            dayNumber.appendChild(document.createTextNode(days[j]));
            day.appendChild(dayNumber);

            if(days[j].length !== 0) // Only add loading image if day is actually a date
            {
                let loadingImage = document.createElement('img');
                loadingImage.classList.add('ticketLoading');
                loadingImage.src = baseURI + 'media/animations/loading.gif';
                day.appendChild(loadingImage);
            }

            if(days[j] !== '')
                displayRow = true;

            // Check if this is the current date
            if(options.year === currentDate.getFullYear() && options.month === currentDate.getMonth()
                && days[j] === currentDate.getDate())
            {
                day.classList.add('currentDate');
            }

            let tickets = document.createElement('ul');

            // Add ticket data
            if(days[j] !== '')
            {
                let dateString = options.year + '-' + ("0" + (options.month  + 1)).slice(-2) + '-' + ("0" + days[j]).slice(-2);
                apiRequest('POST', 'tickets/workspaces/' + getWorkspace() + '/tickets/search', {scheduledDateStart: dateString, scheduledDateEnd: dateString}).done(function(json){
                    if(json.code === 200)
                    {
                        $.each(json.data, function(k, v){
                            let ticket = document.createElement('li');
                            let link = document.createElement('a');

                            link.href = "javascript: goToViewTicket('" + v.number + "')";
                            link.appendChild(document.createTextNode(v.number + ' - ' + v.title));

                            if(v.status === 'Closed')
                                ticket.classList.add('closed');

                            ticket.appendChild(link);
                            tickets.appendChild(ticket);
                        });

                        day.removeChild(day.lastChild);
                        day.appendChild(tickets);
                    }
                });
            }

            week.appendChild(day);
        }

        if(displayRow)
            calendar.appendChild(week);
    }

    container.appendChild(calendar);

    // Remove children from target
    let target = document.getElementById(options.target);

    while(target.firstChild)
    {
        target.removeChild(target.firstChild);
    }

    // Add calendar
    target.appendChild(container);
}

function updateCalendar()
{
    let month = parseInt(document.getElementById('month').value);
    let year = parseInt(document.getElementById('year').value);

    buildCalendar({
        target: 'ticketCalendar',
        year: year,
        month: month
    });
}

$(document).ready(function(){

    let target = document.getElementById('ticketCalendar');
    let date = new Date();

    if(target.length !== 0)
    {
        document.getElementById('month').value = date.getMonth();
        document.getElementById('year').value = date.getFullYear();

        buildCalendar({
            target: 'ticketCalendar',
            year: date.getFullYear(),
            month: date.getMonth()
        });
    }
});
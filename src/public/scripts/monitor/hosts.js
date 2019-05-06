$(document).ready(function(){
    $('#content').css('background-image', "url('" + baseURI + "media/monitor/globe.jpg')").css('background-size', 'cover');

    let container = $('#monitor-container');

    apiRequest('GET', 'hostCategories/displayed', {}).done(function(json){
        // Store categories to load status of
        let categories = [];

        $.each(json.data, function(i, v){
            categories.push(v.id);

            // Create category containers
            let tile = document.createElement('div');
            $(tile).addClass('monitor-tile');
            $(tile).attr('id', 'host-category-' + v.id);

            let title = document.createElement('h3');
            title.appendChild(document.createTextNode(v.name));
            tile.appendChild(title);

            let loadingImage = document.createElement('img');
            $(loadingImage).addClass('monitor-indicator');
            $(loadingImage).attr('src', baseURI + 'media/monitor/loading.gif');
            tile.appendChild(loadingImage);

            let status = document.createElement('span');
            $(status).addClass('monitor-notice');
            tile.appendChild(status);

            let list = document.createElement('ul');
            tile.appendChild(list);

            $(container).append(tile);
        });

        $.each(categories, function(i, l){
            apiRequest('GET', 'hostCategories/' + l + '/status', {}).done(function(json){

                let tile = $('#host-category-' + l);

                let indicator = $(tile).find('.monitor-indicator').first();
                let notice = $(tile).find('.monitor-notice').first();
                let list = $(tile).find('ul').first();

                let offlineCount = 0;
                let total = json.data.length;

                $.each(json.data, function(k, v){
                    if(v.status === 'offline')
                        offlineCount++;

                    let host = document.createElement('li');

                    let status = document.createElement('img');
                    let icon = v.status === 'offline' ? 'fail.png' : 'pass.png'
                    icon = baseURI + 'media/icons/' + icon;
                    $(status).attr('src', icon);

                    host.appendChild(document.createTextNode(v.systemName));
                    host.appendChild(status);

                    $(list).append(host);
                });

                $(notice).append(document.createTextNode('Hosts Offline: ' + offlineCount));

                let icon = 'green-solid.gif';

                if(offlineCount > 0)
                    icon = 'yellow-blink.gif';
                if(offlineCount === total)
                    icon = 'red-blink.gif';

                $(indicator).attr('src', baseURI + 'media/monitor/' + icon);
            });
        });
    });
});
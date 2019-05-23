<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 2:37 PM
 */


namespace views\elements\tickets;


use utilities\InfoCentralConnection;
use views\View;

/**
 * Class TicketNavigation
 *
 * Navigation menu for the ticket module
 *
 * @package views\elements\tickets
 */
class TicketNavigation extends View
{
    private const LINKS = array(
        'myRequests' => array(
            'title' => 'Requests',
            'permission' => 'tickets-customer',
            'link' => 'requests',
            'icon' => 'help.png'
        ),
        'agent' => array(
            'title' => 'Agent',
            'permission' => 'tickets-agent',
            'icon' => 'identity.png',
            'pages' => array(
                array(
                    'title' => 'Service Desk',
                    'link' => 'agent',
                    'icon' => 'ticket.png',
                    'permission' => 'tickets-agent'
                ),
                array(
                    'title' => 'New Ticket',
                    'link' => 'agent/new',
                    'icon' => 'ticket_add.png',
                    'permission' => 'tickets-agent'
                ),
                array(
                    'title' => 'Advanced Search',
                    'link' => 'agent/search',
                    'icon' => 'ticket_search.png',
                    'permission' => 'tickets-agent'
                )
            )
        ),
        'admin' => array(
            'title' => 'Admin',
            'permission' => 'tickets-admin',
            'icon' => 'admin.png',
            'pages' => array(
                array(
                    'title' => 'Workspaces',
                    'permission' => 'tickets-admin',
                    'icon' => 'report.png',
                    'link' => 'admin/workspaces'
                ),
                array(
                    'title' => 'Teams',
                    'permission' => 'tickets-admin',
                    'icon' => 'group.png',
                    'link' => 'admin/teams'
                )
            )
        )
    );

    /**
     * TicketNavigation constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('tickets/TicketNavigation', self::TEMPLATE_ELEMENT);
        $permissions = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser/permissions")->getBody();

        $navigation = '';

        foreach(self::LINKS as $section)
        {
            if(!in_array($section['permission'], $permissions))
                continue;

            if(isset($section['link']))
                $sectionString = "<li><a class='nav-item' href='{{@baseURI}}tickets/{$section['link']}'><img src='{{@baseURI}}media/icons/{$section['icon']}' alt=''>{$section['title']}</a>\n";
            else
                $sectionString = "<li><span class='nav-item'><img src='{{@baseURI}}media/icons/{$section['icon']}' alt=''>{$section['title']}</span>\n";

            if(isset($section['pages']))
            {
                $sectionString .= "<ul>\n";

                foreach($section['pages'] as $page)
                {
                    if(!in_array($page['permission'], $permissions))
                        continue;

                    if(isset($page['icon']))
                        $icon = "<img src='{{@baseURI}}media/icons/{$page['icon']}' alt=''>";
                    else
                        $icon = "";

                    $sectionString .= "<li><a href='{{@baseURI}}tickets/{$page['link']}'>" . $icon . "{$page['title']}</a></li>";
                }

                $sectionString .= "</ul>\n";
            }

            $sectionString .= "</li>";

            $navigation .= $sectionString;
        }

        $this->setVariable("navigation", $navigation);
    }
}
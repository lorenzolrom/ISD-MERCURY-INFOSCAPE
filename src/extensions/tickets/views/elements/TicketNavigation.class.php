<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 2:37 PM
 */


namespace extensions\tickets\views\elements;

use views\elements\Navigation;

/**
 * Class TicketNavigation
 *
 * Navigation menu for the ticket module
 *
 * @package extensions\tickets\views\elements
 */
class TicketNavigation extends Navigation
{
    public const BASE_URI = 'tickets/';

    public const LINKS = array(
        'requests' => array(
            'title' => 'Requests',
            'permission' => 'tickets-customer',
            'link' => 'requests',
            'icon' => 'help'
        ),
        'agent' => array(
            'title' => 'Agent',
            'permission' => 'tickets-agent',
            'icon' => 'work',
            'pages' => array(
                array(
                    'title' => 'Service Desk',
                    'link' => 'agent',
                    'icon' => 'assignment',
                    'permission' => 'tickets-agent'
                ),
                array(
                    'title' => 'Advanced Search',
                    'link' => 'agent/search',
                    'icon' => 'search',
                    'permission' => 'tickets-agent'
                )
            )
        ),
        'admin' => array(
            'title' => 'Admin',
            'permission' => 'tickets-admin',
            'icon' => 'settings_applications',
            'pages' => array(
                array(
                    'title' => 'Workspaces',
                    'permission' => 'tickets-admin',
                    'icon' => 'description',
                    'link' => 'admin/workspaces'
                ),
                array(
                    'title' => 'Teams',
                    'permission' => 'tickets-admin',
                    'icon' => 'group',
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
        parent::__construct(self::BASE_URI, self::LINKS);
    }
}

<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/24/2019
 * Time: 3:30 PM
 */


namespace views\elements\lockshop;

use views\elements\Navigation;

class LIMSNavigation extends Navigation
{
    public const BASE_URI = 'lockshop/';

    public const LINKS = array(
        'systems' => array(
            'title' => 'Systems',
            'permission' => 'lockshop-r',
            'icon' => 'lock_system.png',
            'pages' => array(
                array(
                    'title' => 'Search Systems',
                    'permission' => 'lockshop-r',
                    'link' => 'systems',
                    'icon' => 'lock_system.png',
                    'operation' => 'search'
                ),
                array(
                    'title' => 'New System',
                    'permission' => 'lockshop-r',
                    'link' => 'systems/new',
                    'icon' => 'lock_system.png',
                    'operation' => 'add'
                )
            )
        ),
        'locks' => array(
            'title' => 'Cores',
            'permission' => 'lockshop-r',
            'link' => 'locks',
            'icon' => 'lock.png'
        ),
        'keys' => array(
            'title' => 'Keys',
            'permission' => 'lockshop-r',
            'link' => 'keys',
            'icon' => 'key.png'
        ),
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
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
    private const LINKS = array(
        'systems' => array(
            'title' => 'Systems',
            'permission' => 'lockshop-r',
            'link' => 'systems',
            'icon' => 'lock_system.png'
        ),
        'locks' => array(
            'title' => 'Search Locks',
            'permission' => 'lockshop-r',
            'link' => 'locks',
            'icon' => 'lock.png'
        ),
        'keys' => array(
            'title' => 'Search Keys',
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
        parent::__construct('lockshop/', self::LINKS);
    }
}
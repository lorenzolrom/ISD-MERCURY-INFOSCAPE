<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:10 PM
 */


namespace views\elements\facilities;

use views\elements\Navigation;

class FacilitiesNavigation extends Navigation
{
    public const BASE_URI = 'facilities/';

    public const LINKS = array(
        'buildings' => array(
            'title' => 'Buildings',
            'permission' => 'facilitiescore_facilities-r',
            'icon' => 'building.png',
            'pages' => array(
                array(
                    'title' => 'Search Buildings',
                    'link' => 'buildings',
                    'icon' => 'building.png',
                    'operation' => 'search',
                    'permission' => 'facilitiescore_facilities-r',
                ),
                array(
                    'title' => 'New Building',
                    'link' => 'buildings/new',
                    'icon' => 'building.png',
                    'operation' => 'add',
                    'permission' => 'facilitiescore_facilities-w',
                )
            )
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
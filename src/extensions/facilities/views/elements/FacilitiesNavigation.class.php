<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:10 PM
 */


namespace extensions\facilities\views\elements;

use views\elements\Navigation;

class FacilitiesNavigation extends Navigation
{
    public const BASE_URI = 'facilities/';

    public const LINKS = array(
        'buildings' => array(
            'title' => 'Buildings',
            'permission' => 'facilitiescore_facilities-r',
            'icon' => 'business',
            'pages' => array(
                array(
                    'title' => 'Search Buildings',
                    'link' => 'buildings',
                    'icon' => 'search',
                    'permission' => 'facilitiescore_facilities-r',
                ),
                array(
                    'title' => 'New Building',
                    'link' => 'buildings/new',
                    'icon' => 'add_circle',
                    'permission' => 'facilitiescore_facilities-w',
                )
            )
        ),
        'floorplans' => array(
            'title' => 'Spaces',
            'permission' => 'facilitiescore_floorplans-r',
            'icon' => 'fullscreen',
            'pages' => array(
                array(
                    'title' => 'Search Floorplans',
                    'link' => 'floorplans',
                    'icon' => 'search',
                    'permission' => 'facilitiescore_floorplans-r',
                ),
                array(
                    'title' => 'New Floorplan',
                    'link' => 'floorplans/new',
                    'icon' => 'add_circle',
                    'permission' => 'facilitiescore_floorplans-w',
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

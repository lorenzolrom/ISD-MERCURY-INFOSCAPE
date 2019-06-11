<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:10 PM
 */


namespace views\elements\facilities;

use views\elements\Navigation;

class FacilitiesNavigation extends Navigation
{
    private const LINKS = array(
        'buildings' => array(
            'title' => 'Buildings',
            'permission' => 'facilitiescore_facilities-r',
            'icon' => 'building.png',
            'link' => 'buildings'
        ),
    );

    /**
     * TicketNavigation constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct('facilities/', self::LINKS);
    }
}
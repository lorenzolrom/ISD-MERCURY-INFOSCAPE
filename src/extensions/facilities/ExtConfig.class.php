<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 10/30/2019
 * Time: 1:43 PM
 */


namespace extensions\facilities;


class ExtConfig
{
    public const MENU = array(
        'facilities' => array(
            'title' => 'Facilities',
            'permission' => 'facilities',
            'icon' => 'emedia/facilities/eicon.svg',
            'link' => 'facilities'
        ),
    );

    public const ROUTES = array(
        'facilities' => 'extensions\facilities\controllers\FacilitiesController',
    );
}

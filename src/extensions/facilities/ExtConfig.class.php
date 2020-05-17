<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
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
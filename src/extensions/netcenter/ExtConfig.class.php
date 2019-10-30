<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 10/30/2019
 * Time: 2:40 PM
 */


namespace extensions\netcenter;


class ExtConfig
{
    public const MENU = array(
        'netcenter' => array(
            'title' => 'Net Center',
            'permission' => 'itsm',
            'icon' => 'main.png',
            'link' => 'netcenter'
        ),
    );

    public const ROUTES = array(
        'facilities' => 'extensions\facilities\controllers\FacilitiesController',
    );
}
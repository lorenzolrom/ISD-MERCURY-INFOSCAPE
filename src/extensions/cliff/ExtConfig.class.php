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


namespace extensions\cliff;


class ExtConfig
{
    public const MENU = array(
        'cliff' => array(
            'title' => 'Lock & Key Management',
            'permission' => 'cliff-r',
            'icon' => 'emedia/cliff/eicon.svg',
            'link' => 'cliff'
        ),
    );

    public const ROUTES = array(
        'cliff' => 'extensions\cliff\controllers\CliffController',
    );
}
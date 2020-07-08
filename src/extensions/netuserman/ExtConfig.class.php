<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 3:26 PM
 */


namespace extensions\netuserman;


class ExtConfig
{
    public const MENU = array(
        'netuserman' => array(
            'title' => 'AD Users & Groups',
            'permission' => 'netuserman',
            'icon' => 'emedia/netuserman/eicon.svg',
            'link' => 'netuserman'
        ),
    );

    public const ROUTES = array(
        'netuserman' => 'extensions\netuserman\controllers\NetUserManController',
    );
}

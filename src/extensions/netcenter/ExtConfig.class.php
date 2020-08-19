<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
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
            'icon' => 'emedia/netcenter/eicon.svg',
            'link' => 'netcenter'
        ),
    );

    public const ROUTES = array(
        'netcenter' => 'extensions\netcenter\controllers\NetCenterController'
    );
}

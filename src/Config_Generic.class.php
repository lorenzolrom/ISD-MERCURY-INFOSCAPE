<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 3:21 PM
 */


abstract class Config_Generic
{
    const OPTIONS = array(
        'appName' => 'INFOSCAPE',

        'companyName' => 'Your Company',
        'useCustomStyles' => FALSE,

        'baseURI' => '/',

        'cookieName' => 'ML',

        'icURL' => 'https://infocentral.url/',
        'icSecret' => 'INFOCENTRAL_SECRET',

        // Specify enabled extensions
        'enabledExtensions' => array(
            'netcenter',
            'tickets',
            'facilities',
        ),

        // Specify whitelist I.P. networks for public pages
        'ipWhitelist' => array(
            '10.0.0.0/24'
        )
    );
}

<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 3:21 PM
 */


abstract class Config_Generic
{
    const OPTIONS = array(
        'appName' => 'InfoScape',

        'companyName' => 'Your Company',

        'baseURL' => 'https://your.domain',
        'baseURI' => '/',

        'cookieName' => 'MERLOT',

        'icURL' => 'https://infocentral.url/',
        'icSecret' => 'INFOCENTRAL_SECRET',

        // Optional filter for public pages
        'ipWhitelist' => array(
            '10.0.0.0/24'
        )
    );
}
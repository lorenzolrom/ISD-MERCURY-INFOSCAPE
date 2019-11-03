<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 3:35 PM
 */


namespace extensions\netuserman\views\elements;


use views\elements\Navigation;

class NetUserManNavigation extends Navigation
{
    public const BASE_URI = 'netuserman/';

    public const LINKS = array(
        'netUsers' => array(
            'title' => 'Net Users',
            'permission' => 'netuserman-read',
            'icon' => 'user.png',
            'pages' => array(
                array(
                    'title' => 'Search Users',
                    'operation' => 'search',
                    'permission' => 'netuserman-read',
                    'icon' => 'user.png',
                    'link' => 'search'
                )
            )
        ),
        'netGroups' => array(
            'title' => 'Net Groups',
            'permission' => 'netuserman-readgroups',
            'icon' => 'group.png',
            'pages' => array(
                array(
                    'title' => 'Search Groups',
                    'operation' => 'search',
                    'permission' => 'netuserman-readgroups',
                    'icon' => 'group.png',
                    'link' => 'searchgroups'
                )
            )
        )
    );

    public function __construct()
    {
        parent::__construct(self::BASE_URI, self::LINKS);
    }
}
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
            'icon' => 'account_circle',
            'pages' => array(
                array(
                    'title' => 'Search Users',
                    'permission' => 'netuserman-read',
                    'icon' => 'search',
                    'link' => 'search'
                ),
                array(
                    'title' => 'Create User',
                    'permission' => 'netuserman-create',
                    'icon' => 'add',
                    'link' => 'create'
                )
            )
        ),
        'netGroups' => array(
            'title' => 'Net Groups',
            'permission' => 'netuserman-readgroups',
            'icon' => 'group',
            'pages' => array(
                array(
                    'title' => 'Search Groups',
                    'permission' => 'netuserman-readgroups',
                    'icon' => 'search',
                    'link' => 'searchgroups'
                ),
                array(
                    'title' => 'Create Group',
                    'permission' => 'netuserman-creategroups',
                    'icon' => 'add',
                    'link' => 'creategroup'
                )
            )
        )
    );

    public function __construct()
    {
        parent::__construct(self::BASE_URI, self::LINKS);
    }
}

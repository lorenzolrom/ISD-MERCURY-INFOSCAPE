<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:38 PM
 */


namespace views\elements\admin;


use views\elements\Navigation;

class AdminNavigation extends Navigation
{
    private const LINKS = array(
        array(
            'title' => 'Users',
            'permission' => 'settings',
            'icon' => 'user.png',
            'pages' => array(
                array(
                    'title' => 'Search Users',
                    'link' => 'users',
                    'icon' => 'user.png',
                    'operation' => 'search',
                    'permission' => 'settings'
                ),
                array(
                    'title' => 'New User',
                    'link' => 'users/new',
                    'icon' => 'user.png',
                    'operation' => 'add',
                    'permission' => 'settings'
                ),
                array(
                    'title' => 'Login History',
                    'link' => 'userlogs',
                    'icon' => 'history.png',
                    'permission' => 'settings'
                ),
                array(
                    'title' => 'Audit Permissions',
                    'link' => 'permissions',
                    'icon' => 'account_searchpermissions.png',
                    'permission' => 'settings'
                )
            )
        ),
        array(
            'title' => 'Roles',
            'permission' => 'settings',
            'icon' => 'group.png',
            'pages' => array(
                array(
                    'title' => 'Search Roles',
                    'permission' => 'settings',
                    'icon' => 'group.png',
                    'operation' => 'search',
                    'link' => 'roles'
                ),
                array(
                    'title' => 'New Role',
                    'permission' => 'settings',
                    'icon' => 'group.png',
                    'operation' => 'add',
                    'link' => 'roles/add'
                )
            )
        ),
        array(
            'title' => 'API Keys',
            'permission' => 'api-settings',
            'icon' => 'operator.png',
            'pages' => array(
                array(
                    'title' => 'Search API Keys',
                    'permission' => 'api-settings',
                    'icon' => 'operator.png',
                    'operation' => 'search',
                    'link' => 'icadmin'
                ),
                array(
                    'title' => 'Issue API Key',
                    'permission' => 'api-settings',
                    'icon' => 'operator.png',
                    'operation' => 'add',
                    'link' => 'icadmin/new'
                )
            )
        ),
        array(
            'title' => 'Send Notification',
            'permission' => 'settings',
            'icon' => 'toemail.png',
            'link' => 'notifications/send'
        ),
        array(
            'title' => 'Bulletins',
            'permission' => 'settings',
            'icon' => 'about.png',
            'pages' => array(
                array(
                    'title' => 'Search Bulletins',
                    'permission' => 'settings',
                    'icon' => 'about.png',
                    'operation' => 'search',
                    'link' => 'bulletins',
                ),
                array(
                    'title' => 'New Bulletin',
                    'permission' => 'settings',
                    'icon' => 'about.png',
                    'operation' => 'add',
                    'link' => 'bulletins/new',
                )
            )
        )
    );

    public function __construct()
    {
        parent::__construct('admin/', self::LINKS);
    }
}
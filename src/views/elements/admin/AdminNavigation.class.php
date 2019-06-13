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
            'link' => 'roles'
        ),
        array(
            'title' => 'API Keys',
            'permission' => 'api-settings',
            'icon' => 'operator.png',
            'link' => 'icadmin'
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
            'link' => 'bulletins'
        )
    );

    public function __construct()
    {
        parent::__construct('admin/', self::LINKS);
    }
}
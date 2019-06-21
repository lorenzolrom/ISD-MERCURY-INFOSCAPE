<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 2:44 PM
 */


namespace views\elements;


use utilities\InfoCentralConnection;
use views\View;

class PortalMenu extends View
{
    private const MENU = array(
        'netcenter' => array(
            'title' => 'Net Center',
            'permission' => 'itsm',
            'icon' => 'main.png',
            'link' => 'netcenter'
        ),
        'servicenter' => array(
            'title' => 'Service Center',
            'permission' => 'tickets',
            'icon' => 'ticket.png',
            'link' => 'tickets'
        ),
        'facilities' => array(
            'title' => 'Facilities Management',
            'permission' => 'facilities',
            'icon' => 'facilities.png',
            'link' => 'facilities'
        ),
        'lockshop' => array(
            'title' => 'Lock Management',
            'permission' => 'lockshop',
            'icon' => 'lockshop.png',
            'link' => 'lockshop'
        ),
        'configuration' => array(
            'title' => 'Configuration',
            'permission' => 'settings',
            'icon' => 'config.png',
            'link' => 'admin'
        )
    );

    /**
     * PortalMenu constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('PortalMenu', self::TEMPLATE_ELEMENT);
        $permissions = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser/permissions")->getBody();
        $menu = '';

        foreach(self::MENU as $item)
        {
            if(!in_array($item['permission'], $permissions))
                continue;

            $menu .= "<li><a href='{{@baseURI}}{$item['link']}'><img src='{{@baseURI}}media/menu/{$item['icon']}' alt=''><span>{$item['title']}</span></a></li>";
        }

        $this->setVariable('portalMenu', $menu);
    }
}
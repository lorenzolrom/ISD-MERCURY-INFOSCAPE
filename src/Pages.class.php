<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 3:25 PM
 */

/**
 * Class Pages
 *
 * Define pages, titles, and their permission
 */
abstract class Pages
{
    const HEADER = array(
        'buildings' => array(
            'title' => 'Facilities',
            'permission' => 'facilitiescore_facilities-r',
            'icon' => 'building.png',
            'pages' => array(
                array(
                    'title' => 'Buildings',
                    'permission' => 'facilitiescore_facilities-r',
                    'link' => 'facilities/buildings',
                    'icon' => 'building.png'
                )
            )
        ),
        'inventory' => array(
            'title' => 'Inventory',
            'permission' => 'itsm_inventory',
            'icon' => 'inventory.png',
            'pages' => array(
                array(
                    'title' => 'Assets',
                    'link' => 'inventory/assets',
                    'icon' => 'inventory.png',
                    'permission' => 'itsm_inventory-assets-r'
                ),
                array(
                    'title' => 'Commodities',
                    'link' => 'inventory/commodities',
                    'icon' => 'inventory.png',
                    'permission' => 'itsm_inventory-commodities-r'
                ),
                array(
                    'title' => 'Purchase Orders',
                    'link' => 'inventory/purchaseorders',
                    'icon' => 'purchaseorder.png',
                    'permission' => 'itsm_inventory-purchaseorders-r'
                ),
                array(
                    'title' => 'Returns',
                    'link' => 'inventory/returns',
                    'icon' => 'inventory_return.png',
                    'permission' => 'itsm_inventory-returns-r'
                ),
                array(
                    'title' => 'Discards',
                    'link' => 'inventory/discards',
                    'icon' => 'inventory_delete.png',
                    'permission' => 'itsm_inventory-discards-r'
                ),
                array(
                    'title' => 'Warehouses',
                    'link' => 'inventory/warehouses',
                    'icon' => 'building.png',
                    'permission' => 'itsm_inventory-warehouses-r'
                ),
                array(
                    'title' => 'Vendors',
                    'link' => 'inventory/vendors',
                    'icon' => 'identity.png',
                    'permission' => 'itsm_inventory-vendors-r'
                )
            )
        ),
        'devices' => array(
            'title' => 'Devices',
            'permission' => 'itsm_devices',
            'icon' => 'computer.png',
            'pages' => array(
                array(
                    'title' => 'Hosts',
                    'permission' => 'itsm_devices-hosts-r',
                    'link' => 'devices/hosts',
                    'icon' => 'interface.png'
                )
            )
        ),
        'monitor' => array(
            'title' => 'Monitor',
            'permission' => 'itsmmonitor',
            'link' => 'monitor',
            'icon' => 'monitor.png',
        ),
        'web' => array(
            'title' => 'Web',
            'permission' => 'itsm_web',
            'icon' => 'website.png',
            'pages' => array(
                array(
                    'title' => 'VHosts',
                    'link' => 'web/vhosts',
                    'icon' => 'hostname.png',
                    'permission' => 'itsm_web-vhosts-r'
                ),
                array(
                    'title' => 'Registrars',
                    'link' => 'web/registrars',
                    'icon' => 'identity.png',
                    'permission' => 'itsm_web-registrars-r'
                ),
                array(
                    'title' => 'URL Aliases',
                    'link' => 'web/urlaliases',
                    'icon' => 'hostname.png',
                    'permission' => 'itsm_web-aliases-rw'
                )
            )
        ),
        'ait' => array(
            'title' => 'AIT',
            'permission' => 'itsm_ait',
            'icon' => 'apps.png',
            'pages' => array(
                array(
                    'title' => 'Applications',
                    'permission' => 'itsm_ait-apps-r',
                    'link' => 'ait/applications',
                    'icon' => 'apps.png'
                )
            )
        ),
        'tickets' => array(
            'title' => 'Tickets',
            'permission' => 'servicenter',
            'icon' => 'ticket.png',
            'pages' => array(
                array(
                    'title' => 'Requests',
                    'link' => 'tickets/requests',
                    'icon' => 'ticket.png',
                    'permission' => 'servicenter_requests'
                ),
                array(
                    'title' => 'Service Desk',
                    'link' => 'tickets/servicedesk',
                    'icon' => 'ticket.png',
                    'permission' => 'servicenter_desk-r'
                ),
                array(
                    'title' => 'Workspaces',
                    'link' => 'tickets/workspaces',
                    'icon' => 'report.png',
                    'permission' => 'servicenter_admin'
                ),
                array(
                    'title' => 'Teams',
                    'link' => 'tickets/teams',
                    'icon' => 'group.png',
                    'permission' => 'servicenter_admin'
                )
            )
        ),
        'settings' => array(
            'title' => 'Admin',
            'permission' => 'settings',
            'icon' => 'admin.png',
            'pages' => array(
                array(
                    'title' => 'Users',
                    'permission' => 'settings',
                    'icon' => 'user.png',
                    'link' => 'admin/users'
                ),
                array(
                    'title' => 'Roles',
                    'permission' => 'settings',
                    'icon' => 'group.png',
                    'link' => 'admin/roles'
                ),
                array(
                    'title' => 'Authorized Apps',
                    'permission' => 'api-settings',
                    'icon' => 'apps.png',
                    'link' => 'admin/icadmin'
                ),
                array(
                    'title' => 'Notifications',
                    'permission' => 'settings',
                    'icon' => 'mail.png',
                    'link' => 'admin/notifications'
                ),
                array(
                    'title' => 'Bulletins',
                    'permission' => 'settings',
                    'icon' => 'about.png',
                    'link' => 'admin/bulletins'
                )
            )
        )
    );

    const MENUS = array(
        'home' => array(
            'title' => Config::OPTIONS['appName'],
            'pages' => array(
                'title' => 'Change Password',
                'link' => 'account/changepassword'
            )
        )
    );
}
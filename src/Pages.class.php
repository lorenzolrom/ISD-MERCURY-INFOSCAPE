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
        array(
            'title' => 'Buildings',
            'permission' => 'facilitiescore_facilities-r',
            'link' => 'buildings',
            'icon' => 'building.png',
        ),
        array(
            'title' => 'Inventory',
            'permission' => 'itsm_inventory',
            'link' => '#',
            'icon' => 'inventory.png',
            'pages' => array(
                array(
                    'title' => 'Assets',
                    'link' => 'inventory/assets',
                    'permission' => 'itsm_inventory-assets-r'
                ),
                array(
                    'title' => 'Commodities',
                    'link' => 'inventory/commodities',
                    'permission' => 'itsm_inventory-commodities-rw'
                ),
                array(
                    'title' => 'Purchase Orders',
                    'link' => 'inventory/purchaseorders',
                    'permission' => 'itsm_inventory-purchaseorders-rw'
                ),
                array(
                    'title' => 'Returns',
                    'link' => 'inventory/returns',
                    'permission' => 'itsm_inventory-returns-rw'
                )
            )
        ),
        array(
            'title' => 'Hosts',
            'permission' => 'itsm_devices',
            'link' => 'hosts',
            'icon' => 'computer.png',
        ),
        array(
            'title' => 'Monitor',
            'permission' => 'itsmmonitor',
            'link' => '#',
            'icon' => 'monitor.png',
            'pages' => array(
                array(
                    'title' => 'Host Monitor',
                    'link' => 'monitor/hosts',
                    'permission' => 'itsmmonitor-hosts-r'
                ),
                array(
                    'title' => 'Service Monitor',
                    'link' => 'monitor/services',
                    'permission' => 'itsmmonitor-services-r'
                )
            )
        ),
        array(
            'title' => 'Web',
            'permission' => 'itsm_web',
            'link' => '#',
            'icon' => 'hostname.png',
            'pages' => array(
                array(
                    'title' => 'VHosts',
                    'link' => 'web/vhosts',
                    'permission' => 'itsm_web-vhosts-r'
                ),
                array(
                    'title' => 'Registrars',
                    'link' => 'web/registrars',
                    'permission' => 'itsm_web-registrars-r'
                ),
                array(
                    'title' => 'URL Aliases',
                    'link' => 'web/urlaliases',
                    'permission' => 'itsm_web-aliases-rw'
                ),
                array(
                    'title' => 'Site Logs',
                    'link' => 'web/sitelogs',
                    'permission' => 'itsm_weblogs'
                )
            )
        ),
        array(
            'title' => 'Applications',
            'permission' => 'itsm_ait',
            'link' => 'applications',
            'icon' => 'apps.png',
        ),
        array(
            'title' => 'Tickets',
            'permission' => 'servicenter',
            'link' => '#',
            'icon' => 'ticket.png',
            'pages' => array(
                array(
                    'title' => 'Requests',
                    'link' => 'tickets/requests',
                    'permission' => 'servicenter_requests'
                ),
                array(
                    'title' => 'Service Desk',
                    'link' => 'tickets/servicedesk',
                    'permission' => 'servicenter_desk-r'
                ),
                array(
                    'title' => 'Workspaces',
                    'link' => 'tickets/workspaces',
                    'permission' => 'servicenter_admin'
                ),
                array(
                    'title' => 'Teams',
                    'link' => 'tickets/teams',
                    'permission' => 'servicenter_admin'
                )
            )
        ),
        array(
            'title' => 'Settings',
            'permission' => 'settings',
            'link' => 'settings/users',
            'icon' => 'admin.png',
            'pages' => array(
                array(
                    'title' => 'Users',
                    'permission' => 'settings',
                    'link' => 'settings/users'
                ),
                array(
                    'title' => 'Roles',
                    'permission' => 'settings',
                    'link' => 'settings/roles'
                ),
                array(
                    'title' => 'Notifications',
                    'permission' => 'settings',
                    'link' => 'settings/notifications'
                ),
                array(
                    'title' => 'Bulletins',
                    'permission' => 'settings',
                    'link' => 'settings/bulletins'
                )
            )
        )
    );
}
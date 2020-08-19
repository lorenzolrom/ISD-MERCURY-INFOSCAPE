<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 4:48 PM
 */


namespace extensions\netcenter\views\elements;

use views\elements\Navigation;

class NetCenterNavigation extends Navigation
{
    public const BASE_URI = 'netcenter/';

    public const LINKS = array(
        'inventory' => array(
            'title' => 'Inventory',
            'permission' => 'itsm_inventory',
            'icon' => 'view_list',
            'pages' => array(
                array(
                    'title' => 'Assets',
                    'link' => 'inventory/assets',
                    'icon' => 'class',
                    'permission' => 'itsm_inventory-assets-r'
                ),
                array(
                    'title' => 'Commodities',
                    'link' => 'inventory/commodities',
                    'icon' => 'shopping_cart',
                    'permission' => 'itsm_inventory-commodities-r'
                ),
                array(
                    'title' => 'Purchase Orders',
                    'link' => 'inventory/purchaseorders',
                    'icon' => 'monetization_on',
                    'permission' => 'itsm_inventory-purchaseorders-r'
                ),
                array(
                    'title' => 'Discards',
                    'link' => 'inventory/discards',
                    'icon' => 'delete_forever',
                    'permission' => 'itsm_inventory-discards-r'
                ),
                array(
                    'title' => 'Warehouses',
                    'link' => 'inventory/warehouses',
                    'icon' => 'local_shipping',
                    'permission' => 'itsm_inventory-warehouses-r'
                ),
                array(
                    'title' => 'Vendors',
                    'link' => 'inventory/vendors',
                    'icon' => 'work',
                    'permission' => 'itsm_inventory-vendors-r'
                )
            )
        ),
        'devices' => array(
            'title' => 'Devices',
            'permission' => 'itsm_devices',
            'icon' => 'desktop_windows',
            'pages' => array(
                array(
                    'title' => 'Hosts',
                    'permission' => 'itsm_devices-hosts-r',
                    'link' => 'devices/hosts',
                    'icon' => 'desktop_windows',
                ),
                array(
                    'title' => 'DHCP Logs',
                    'permission' => 'itsm_dhcplogs-r',
                    'link' => 'devices/dhcplogs',
                    'icon' => 'description'
                ),
            )
        ),
        'web' => array(
            'title' => 'Web',
            'permission' => 'itsm_web',
            'icon' => 'language',
            'pages' => array(
                array(
                    'title' => 'VHosts',
                    'link' => 'web/vhosts',
                    'icon' => 'dns',
                    'permission' => 'itsm_web-vhosts-r'
                ),
                array(
                    'title' => 'URL Aliases',
                    'link' => 'web/urlaliases',
                    'icon' => 'forward',
                    'permission' => 'itsm_web-aliases-rw',
                ),
                array(
                    'title' => 'Registrars',
                    'link' => 'web/registrars',
                    'icon' => 'work',
                    'permission' => 'itsm_web-registrars-r'
                )
            )
        ),
        'ait' => array(
            'title' => 'Applications',
            'permission' => 'itsm_ait',
            'icon' => 'developer_board',
            'link' => 'ait/applications'
        ),
        'monitor' => array(
            'title' => 'Monitor',
            'permission' => 'itsmmonitor',
            'link' => 'monitor',
            'icon' => 'dashboard',
        )
    );

    /**
     * Navigation constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct(self::BASE_URI, self::LINKS);
    }
}

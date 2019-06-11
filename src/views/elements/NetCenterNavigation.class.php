<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 4:48 PM
 */


namespace views\elements;

class NetCenterNavigation extends Navigation
{
    public const LINKS = array(
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
                    'title' => 'Discards',
                    'link' => 'inventory/discards',
                    'icon' => 'discardorder.png',
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
        )
    );

    /**
     * Navigation constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct('', self::LINKS);
    }
}
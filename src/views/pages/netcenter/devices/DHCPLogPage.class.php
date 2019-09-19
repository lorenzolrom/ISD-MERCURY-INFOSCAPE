<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/19/2019
 * Time: 2:28 PM
 */


namespace views\pages\netcenter\devices;


use views\pages\netcenter\ModelPage;
use views\pages\netcenter\NetCenterDocument;

class DHCPLogPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_dhcplogs-r', 'devices');

        $this->setVariable('content', self::templateFileContents('devices/DHCPLogPage', self::TEMPLATE_PAGE));
        $this->setVariable('tabTitle', "View DHCP Logs");
    }
}
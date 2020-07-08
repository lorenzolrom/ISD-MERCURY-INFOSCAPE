<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 9/19/2019
 * Time: 2:28 PM
 */


namespace extensions\netcenter\views\pages\devices;

use extensions\netcenter\views\pages\NetCenterDocument;

class DHCPLogPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_dhcplogs-r', 'devices');

        $this->setVariable('content', self::templateFileContents('devices/DHCPLogPage', self::TEMPLATE_PAGE, 'netcenter'));
        $this->setVariable('tabTitle', "View DHCP Logs");
    }
}

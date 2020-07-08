<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 8:41 PM
 */


namespace extensions\netcenter\views\pages\devices;


use extensions\netcenter\views\pages\NetCenterDocument;

class HostSearchPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct("itsm_devices-hosts-r", 'devices');

        $this->setVariable('tabTitle', 'Hosts');
        $this->setVariable('content', self::templateFileContents('devices/HostSearchPage', self::TEMPLATE_PAGE, 'netcenter'));
    }
}

<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 1:29 AM
 */


namespace extensions\netcenter\views\pages\monitor;


use extensions\netcenter\views\pages\NetCenterDocument;

class HostMonitor extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsmmonitor-hosts-r', 'monitor');

        $this->setVariable('tabTitle', 'Host Monitor');
        $this->setVariable('content', self::templateFileContents('monitor/HostMonitor', self::TEMPLATE_PAGE, 'netcenter'));
    }
}

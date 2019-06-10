<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 1:29 AM
 */


namespace views\pages\monitor;


use views\pages\MainDocument;

class HostMonitor extends MainDocument
{
    public function __construct()
    {
        parent::__construct('itsmmonitor-hosts-r', 'monitor');

        $this->setVariable('tabTitle', 'Host Monitor');
        $this->setVariable('content', self::templateFileContents('monitor/HostMonitor', self::TEMPLATE_PAGE));
    }
}
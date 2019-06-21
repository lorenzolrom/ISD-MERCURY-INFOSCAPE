<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 9:36 AM
 */


namespace views\pages\netcenter\monitor;


use views\pages\netcenter\NetCenterDocument;

class HostCategoryListPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsmmonitor-hosts-w', 'monitor');

        $this->setVariable('tabTitle', 'Monitor Configuration');
        $this->setVariable('content', self::templateFileContents('monitor/HostCategoryListPage', self::TEMPLATE_PAGE));
    }
}
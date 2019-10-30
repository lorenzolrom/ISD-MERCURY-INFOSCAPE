<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 9:36 AM
 */


namespace extensions\netcenter\views\pages\monitor;


use extensions\netcenter\views\pages\NetCenterDocument;

class HostCategoryListPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsmmonitor-hosts-w', 'monitor');

        $this->setVariable('tabTitle', 'Monitor Configuration');
        $this->setVariable('content', self::templateFileContents('monitor/HostCategoryListPage', self::TEMPLATE_PAGE, 'netcenter'));
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/01/2019
 * Time: 6:56 AM
 */


namespace extensions\netcenter\views\pages\web;


use utilities\InfoCentralConnection;
use extensions\netcenter\views\pages\NetCenterDocument;

class VHostSearchPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_web-vhosts-r', 'web');

        // Get status codes
        $statuses = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'vhosts/statuses')->getBody();
        $statusSelect = "";

        foreach($statuses as $status)
        {
            $statusSelect .= "<option value='{$status['code']}'>{$status['name']}</option>\n";
        }

        $this->setVariable('tabTitle', 'VHosts');
        $this->setVariable('content', self::templateFileContents('web/VHostSearchPage', self::TEMPLATE_PAGE, 'netcenter'));
        $this->setVariable('statusSelect', $statusSelect);
    }
}
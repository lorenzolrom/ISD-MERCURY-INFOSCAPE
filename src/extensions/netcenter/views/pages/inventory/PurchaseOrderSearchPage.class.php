<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/10/2019
 * Time: 2:09 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use utilities\InfoCentralConnection;
use extensions\netcenter\views\pages\NetCenterDocument;

class PurchaseOrderSearchPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-purchaseorders-r', 'inventory');

        $this->setVariable('tabTitle', 'Purchase Orders');
        $this->setVariable('content', self::templateFileContents('inventory/PurchaseOrderSearchPage', self::TEMPLATE_PAGE, 'netcenter'));

        $statuses = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'purchaseorders/statuses')->getBody();

        $statusSelect = '';

        foreach($statuses as $status)
        {
            $statusSelect .= "<option value='{$status['code']}'>{$status['name']}</option>";
        }

        $this->setVariable('statusSelect', $statusSelect);
    }
}

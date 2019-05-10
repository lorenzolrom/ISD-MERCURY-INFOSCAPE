<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/10/2019
 * Time: 2:09 PM
 */


namespace views\pages\inventory;


use utilities\InfoCentralConnection;
use views\pages\UserDocument;

class PurchaseOrderSearchPage extends UserDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-purchaseorders-r', 'inventory');

        $this->setVariable('tabTitle', 'Purchase Orders');
        $this->setVariable('content', self::templateFileContents('inventory/PurchaseOrderSearchPage', self::TEMPLATE_PAGE));

        $statuses = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'purchaseorders/statuses')->getBody();

        $statusSelect = '';

        foreach($statuses as $status)
        {
            $statusSelect .= "<option value='{$status['code']}'>{$status['name']}</option>";
        }

        $this->setVariable('statusSelect', $statusSelect);
    }
}
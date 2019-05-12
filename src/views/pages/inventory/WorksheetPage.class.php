<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/12/2019
 * Time: 3:59 PM
 */


namespace views\pages\inventory;


use views\pages\UserDocument;

class WorksheetPage extends UserDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-assets-r', 'inventory');

        $this->setVariable('tabTitle', 'Asset Worksheet');
        $this->setVariable('content', self::templateFileContents('inventory/AssetWorksheet', self::TEMPLATE_PAGE));
    }
}
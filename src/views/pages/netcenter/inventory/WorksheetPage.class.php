<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/12/2019
 * Time: 3:59 PM
 */


namespace views\pages\netcenter\inventory;


use views\pages\netcenter\NetCenterDocument;

class WorksheetPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-assets-r', 'inventory');

        $this->setVariable('tabTitle', 'Asset Worksheet');
        $this->setVariable('content', self::templateFileContents('inventory/AssetWorksheet', self::TEMPLATE_PAGE));
    }
}
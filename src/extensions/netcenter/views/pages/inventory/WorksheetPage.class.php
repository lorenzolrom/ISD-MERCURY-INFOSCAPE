<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/12/2019
 * Time: 3:59 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\pages\NetCenterDocument;

class WorksheetPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-assets-r', 'inventory');

        $this->setVariable('tabTitle', 'Asset Worksheet');
        $this->setVariable('content', self::templateFileContents('inventory/AssetWorksheet', self::TEMPLATE_PAGE, 'netcenter'));
    }
}

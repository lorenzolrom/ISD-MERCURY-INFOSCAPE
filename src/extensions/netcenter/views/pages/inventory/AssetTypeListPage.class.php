<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/13/2019
 * Time: 12:13 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\pages\NetCenterDocument;

class AssetTypeListPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct("itsm_inventory-commodities-r", 'inventory');

        $this->setVariable("tabTitle", "Asset Types");
        $this->setVariable("content", self::templateFileContents("inventory/AssetTypeList", self::TEMPLATE_PAGE, 'netcenter'));
    }
}

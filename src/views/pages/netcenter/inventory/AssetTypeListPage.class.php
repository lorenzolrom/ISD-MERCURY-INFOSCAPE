<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 4/13/2019
 * Time: 12:13 PM
 */


namespace views\pages\netcenter\inventory;


use views\pages\netcenter\NetCenterDocument;

class AssetTypeListPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct("itsm_inventory-commodities-r", 'inventory');

        $this->setVariable("tabTitle", "Asset Types");
        $this->setVariable("content", self::templateFileContents("inventory/AssetTypeList", self::TEMPLATE_PAGE));
    }
}
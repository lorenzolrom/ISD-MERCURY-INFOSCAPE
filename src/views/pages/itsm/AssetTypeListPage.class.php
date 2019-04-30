<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/13/2019
 * Time: 12:13 PM
 */


namespace views\pages\itsm;


use views\pages\UserDocument;

class AssetTypeListPage extends UserDocument
{
    public function __construct()
    {
        parent::__construct("itsm_inventory-commodities-r", 'inventory');

        $this->setVariable("tabTitle", "Asset Types");
        $this->setVariable("content", self::templateFileContents("itsm/AssetTypeList", self::TEMPLATE_CONTENT));
    }
}
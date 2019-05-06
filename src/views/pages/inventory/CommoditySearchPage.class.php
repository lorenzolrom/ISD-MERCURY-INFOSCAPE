<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 3:41 PM
 */


namespace views\pages\inventory;


use utilities\InfoCentralConnection;
use views\pages\UserDocument;

class CommoditySearchPage extends UserDocument
{
    public function __construct()
    {
        parent::__construct("itsm_inventory-commodities-r", 'inventory');

        $this->setVariable("tabTitle", "Commodities");
        $this->setVariable("content", self::templateFileContents("inventory/CommoditySearchPage", self::TEMPLATE_PAGE));

        $assetTypes = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "commodities/assetTypes")->getBody();
        $commodityTypes = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "commodities/commodityTypes")->getBody();

        $assetTypeSelect = "";

        foreach($assetTypes as $assetType)
        {
            $assetTypeSelect .= "<option value='{$assetType['code']}'>{$assetType['name']}</option>\n";
        }

        $this->setVariable("assetTypeSelect", $assetTypeSelect);

        $commodityTypeSelect = "";

        foreach($commodityTypes as $commodityType)
        {
            $commodityTypeSelect .= "<option value='{$commodityType['code']}'>{$commodityType['name']}</option>\n";
        }

        $this->setVariable("commodityTypeSelect", $commodityTypeSelect);

    }
}
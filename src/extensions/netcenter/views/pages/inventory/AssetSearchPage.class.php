<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/15/2019
 * Time: 7:35 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use utilities\InfoCentralConnection;
use extensions\netcenter\views\pages\NetCenterDocument;

class AssetSearchPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct("itsm_inventory-assets-r", 'inventory');

        $this->setVariable("tabTitle", "Assets");
        $this->setVariable("content", self::templateFileContents("inventory/AssetSearchPage", self::TEMPLATE_PAGE, 'netcenter'));

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

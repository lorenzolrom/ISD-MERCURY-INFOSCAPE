<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 11:48 PM
 */


namespace views\forms\inventory;


use utilities\InfoCentralConnection;
use views\forms\Form;

class CommodityForm extends Form
{
    /**
     * CommodityForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML("inventory/CommodityForm", self::TEMPLATE_FORM);

        $assetTypes = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "commodities/assetTypes")->getBody();
        $commodityTypes = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "commodities/commodityTypes")->getBody();

        $assetTypeSelect = "";

        if($details !== NULL)
        {
            $this->setVariable("code", $details['code']);
            $this->setVariable("name", $details['name']);
            $this->setVariable("model", $details['model']);
            $this->setVariable("manufacturer", $details['manufacturer']);
            $this->setVariable("unitCost", $details['unitCost']);
        }

        foreach($assetTypes as $assetType)
        {
            $selected = "";
            if(isset($details['assetType']) AND $details['assetType'] == $assetType['code'])
                $selected = "selected";

            $assetTypeSelect .= "<option value='{$assetType['code']}' $selected>{$assetType['name']}</option>\n";
        }

        $this->setVariable("assetTypeSelect", $assetTypeSelect);

        $commodityTypeSelect = "";

        foreach($commodityTypes as $commodityType)
        {
            $selected = "";
            if(isset($details['commodityType']) AND $details['commodityType'] == $commodityType['code'])
                $selected = "selected";

            $commodityTypeSelect .= "<option value='{$commodityType['code']}' $selected>{$commodityType['name']}</option>\n";
        }

        $this->setVariable("commodityTypeSelect", $commodityTypeSelect);
    }
}
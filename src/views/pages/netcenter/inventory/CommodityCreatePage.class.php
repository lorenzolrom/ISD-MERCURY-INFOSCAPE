<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 11:51 PM
 */


namespace views\pages\netcenter\inventory;


use views\forms\netcenter\inventory\CommodityForm;
use views\pages\netcenter\NetCenterDocument;

class CommodityCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-commodities-w', 'inventory');

        $this->setVariable("tabTitle", "Commodity (New)");

        $form = new CommodityForm();

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}netcenter/inventory/commodities");
        $this->setVariable("formScript", "return createCommodity()");
    }
}
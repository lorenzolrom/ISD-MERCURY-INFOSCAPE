<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 11:51 PM
 */


namespace views\pages\inventory;


use views\forms\inventory\CommodityForm;
use views\pages\UserDocument;

class CommodityCreatePage extends UserDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-commodities-w', 'inventory');

        $this->setVariable("tabTitle", "Commodity (New)");

        $form = new CommodityForm();

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}inventory/commodities");
        $this->setVariable("formScript", "return createCommodity()");
    }
}
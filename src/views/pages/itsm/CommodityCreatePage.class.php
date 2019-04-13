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


namespace views\pages\itsm;


use views\forms\itsm\CommodityForm;
use views\pages\ApplicationPage;

class CommodityCreatePage extends ApplicationPage
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
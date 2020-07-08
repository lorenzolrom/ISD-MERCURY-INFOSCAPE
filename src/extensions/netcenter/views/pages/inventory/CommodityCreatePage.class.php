<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 11:51 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\forms\inventory\CommodityForm;
use extensions\netcenter\views\pages\NetCenterDocument;

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

<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/14/2019
 * Time: 11:59 AM
 */


namespace views\pages\itsm;


use views\forms\itsm\WarehouseForm;
use views\pages\ApplicationPage;

class WarehouseCreatePage extends ApplicationPage
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-warehouses-w', 'inventory');

        $this->setVariable("tabTitle", "Warehouse (New)");

        $form = new WarehouseForm();

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}inventory/warehouses");
        $this->setVariable("formScript", "return createWarehouse()");
    }
}
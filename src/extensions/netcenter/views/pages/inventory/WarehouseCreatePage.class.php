<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/14/2019
 * Time: 11:59 AM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\forms\inventory\WarehouseForm;
use extensions\netcenter\views\pages\NetCenterDocument;

class WarehouseCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-warehouses-w', 'inventory');

        $this->setVariable("tabTitle", "Warehouse (New)");

        $form = new WarehouseForm();

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}netcenter/inventory/warehouses");
        $this->setVariable("formScript", "return createWarehouse()");
    }
}
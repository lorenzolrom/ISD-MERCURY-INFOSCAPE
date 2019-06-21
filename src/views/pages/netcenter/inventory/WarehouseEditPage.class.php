<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/14/2019
 * Time: 12:15 PM
 */


namespace views\pages\netcenter\inventory;


use views\forms\inventory\WarehouseForm;
use views\pages\netcenter\ModelPage;

class WarehouseEditPage extends ModelPage
{
    /**
     * WarehouseEditPage constructor.
     * @param string|null $warehouseId
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $warehouseId)
    {
        parent::__construct("warehouses/$warehouseId", 'itsm_inventory-warehouses-r', 'inventory');

        $details = $this->response->getBody();

        $this->setVariable("tabTitle", "Warehouse - " . $details['name'] . " (Edit)");

        $form = new WarehouseForm($details);

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}netcenter/inventory/warehouses");
        $this->setVariable("formScript", "return saveChanges('{{@id}}')");
        $this->setVariable("id", $warehouseId);
    }
}
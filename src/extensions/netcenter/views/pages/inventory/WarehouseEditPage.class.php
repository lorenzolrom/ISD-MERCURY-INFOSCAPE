<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/14/2019
 * Time: 12:15 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\forms\inventory\WarehouseForm;
use extensions\netcenter\views\pages\ModelPage;


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

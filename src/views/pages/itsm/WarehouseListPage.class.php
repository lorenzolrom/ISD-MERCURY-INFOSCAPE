<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/14/2019
 * Time: 10:52 AM
 */


namespace views\pages\itsm;


use views\pages\UserDocument;

class WarehouseListPage extends UserDocument
{
    public function __construct()
    {
        parent::__construct("itsm_inventory-warehouses-r", 'inventory');

        $this->setVariable("tabTitle", "Warehouses");
        $this->setVariable("content", self::templateFileContents("itsm/WarehouseListPage", self::TEMPLATE_CONTENT));
    }
}
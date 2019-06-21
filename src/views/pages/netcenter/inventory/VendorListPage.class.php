<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 4/25/2019
 * Time: 11:34 AM
 */


namespace views\pages\netcenter\inventory;


use views\pages\netcenter\NetCenterDocument;

class VendorListPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-vendors-r', 'inventory');

        $this->setVariable("tabTitle", "Vendors");
        $this->setVariable("content", self::templateFileContents("inventory/VendorListPage", self::TEMPLATE_PAGE));
    }
}
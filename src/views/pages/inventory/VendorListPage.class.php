<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/25/2019
 * Time: 11:34 AM
 */


namespace views\pages\inventory;


use views\pages\MainDocument;

class VendorListPage extends MainDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-vendors-r', 'inventory');

        $this->setVariable("tabTitle", "Vendors");
        $this->setVariable("content", self::templateFileContents("inventory/VendorListPage", self::TEMPLATE_PAGE));
    }
}
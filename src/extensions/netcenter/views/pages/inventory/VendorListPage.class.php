<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/25/2019
 * Time: 11:34 AM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\pages\NetCenterDocument;

class VendorListPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-vendors-r', 'inventory');

        $this->setVariable("tabTitle", "Vendors");
        $this->setVariable("content", self::templateFileContents("inventory/VendorListPage", self::TEMPLATE_PAGE, 'netcenter'));
    }
}

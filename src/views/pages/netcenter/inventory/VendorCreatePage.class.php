<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/25/2019
 * Time: 9:13 PM
 */


namespace views\pages\netcenter\inventory;


use views\forms\inventory\VendorForm;
use views\pages\netcenter\NetCenterDocument;

class VendorCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-vendors-w', 'inventory');

        $this->setVariable("tabTitle", "Vendor (New)");

        $form = new VendorForm();

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}netcenter/inventory/vendors");
        $this->setVariable("formScript", "return createVendor()");
    }
}
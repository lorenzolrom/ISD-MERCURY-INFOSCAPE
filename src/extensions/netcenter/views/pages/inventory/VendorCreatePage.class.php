<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/25/2019
 * Time: 9:13 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\forms\inventory\VendorForm;
use extensions\netcenter\views\pages\NetCenterDocument;

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

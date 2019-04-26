<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/25/2019
 * Time: 9:13 PM
 */


namespace views\pages\itsm;


use views\forms\itsm\VendorForm;
use views\pages\ApplicationPage;

class VendorCreatePage extends ApplicationPage
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-vendors-w', 'inventory');

        $this->setVariable("tabTitle", "Vendor (New)");

        $form = new VendorForm();

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}inventory/vendors");
        $this->setVariable("formScript", "return createVendor()");
    }
}
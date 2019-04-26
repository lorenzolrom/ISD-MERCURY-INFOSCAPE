<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/25/2019
 * Time: 3:13 PM
 */


namespace views\pages\itsm;


use views\forms\itsm\VendorForm;
use views\pages\ModelPage;

class VendorEditPage extends ModelPage
{
    /**
     * VendorEditPage constructor.
     * @param string|null $vendorId
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $vendorId)
    {
        parent::__construct("vendors/$vendorId", 'itsm_inventory-vendors-r', 'inventory');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Vendor - ' . $details['name'] . ' (Edit)');

        $form = new VendorForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}inventory/vendors");
        $this->setVariable("formScript", "return saveChanges('{{@id}}')");
        $this->setVariable("id", $vendorId);

        $this->setVariables($details);
    }
}
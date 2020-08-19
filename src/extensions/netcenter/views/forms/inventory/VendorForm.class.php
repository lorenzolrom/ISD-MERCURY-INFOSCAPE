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
 * Time: 3:10 PM
 */


namespace extensions\netcenter\views\forms\inventory;


use views\forms\Form;

class VendorForm extends Form
{
    /**
     * VendorForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML("inventory/VendorForm", self::TEMPLATE_FORM, 'netcenter');

        if($details !== NULL)
        {
            $this->setVariable('code', $details['code']);
            $this->setVariable('name', htmlentities($details['name']));
            $this->setVariable('streetAddress', htmlentities($details['streetAddress']));
            $this->setVariable('city', htmlentities($details['city']));
            $this->setVariable('state', htmlentities($details['state']));
            $this->setVariable('zipCode', htmlentities($details['zipCode']));
            $this->setVariable('phone', htmlentities($details['phone']));
            $this->setVariable('fax', htmlentities($details['fax']));
        }
    }
}

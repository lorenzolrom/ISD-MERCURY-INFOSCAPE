<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/10/2019
 * Time: 9:31 AM
 */


namespace extensions\facilities\views\forms;


use views\forms\Form;

class BuildingForm extends Form
{
    /**
     * BuildingForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML("BuildingForm", self::TEMPLATE_FORM, 'facilities');

        if($details !== NULL)
        {
            $this->setVariable('id', $details['id']);
            $this->setVariable('code', htmlentities($details['code']));
            $this->setVariable('name', htmlentities($details['name']));
            $this->setVariable('streetAddress', htmlentities($details['streetAddress']));
            $this->setVariable('city', htmlentities($details['city']));
            $this->setVariable('state', htmlentities($details['state']));
            $this->setVariable('zipCode', htmlentities($details['zipCode']));
        }
    }
}

<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 4/10/2019
 * Time: 9:31 AM
 */


namespace views\forms\facilities;


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
        $this->setTemplateFromHTML("facilities/BuildingForm", self::TEMPLATE_FORM);

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
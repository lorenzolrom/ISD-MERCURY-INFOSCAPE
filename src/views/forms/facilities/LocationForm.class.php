<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/10/2019
 * Time: 8:49 PM
 */


namespace views\forms\facilities;


use views\forms\Form;

class LocationForm extends Form
{
    /**
     * LocationForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(array $details = NULL)
    {
        $this->setTemplateFromHTML("facilities/LocationForm", self::TEMPLATE_FORM);

        $this->setVariable("buildingId", $details['buildingId']);
        $this->setVariable("buildingName", htmlentities($details['buildingName']));
        $this->setVariable("buildingCode", htmlentities($details['buildingCode']));

        if(isset($details['code']) AND isset($details['name']))
        {
            $this->setVariable('code', htmlentities($details['code']));
            $this->setVariable('name', htmlentities($details['name']));
        }
    }

    public function validateForm(): array
    {
        return array();
    }
}
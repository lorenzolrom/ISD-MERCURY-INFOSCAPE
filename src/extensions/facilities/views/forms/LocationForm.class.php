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
 * Time: 8:49 PM
 */


namespace extensions\facilities\views\forms;


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
        $this->setTemplateFromHTML("LocationForm", self::TEMPLATE_FORM, 'facilities');

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

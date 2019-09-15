<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 12:51 PM
 */


namespace views\forms\tickets;


use utilities\InfoCentralConnection;
use views\forms\Form;

class RequestCreateForm extends Form
{
    /**
     * RequestCreateForm constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('tickets/RequestCreateForm', self::TEMPLATE_FORM);

        $attributeTypes = array('category', 'type');

        // Get attributes for request portal
        foreach($attributeTypes as $attributeType)
        {
            $attributes = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'tickets/requests/attributes/' . $attributeType)->getBody();

            $select = '';

            foreach($attributes as $attribute)
            {
                $select .= "<option value='{$attribute['code']}'>{$attribute['name']}</option>";
            }

            $this->setVariable($attributeType . 'Select', $select);
        }
    }
}
<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 12:51 PM
 */


namespace extensions\tickets\views\forms;


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
        $this->setTemplateFromHTML('RequestCreateForm', self::TEMPLATE_FORM, 'tickets');

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

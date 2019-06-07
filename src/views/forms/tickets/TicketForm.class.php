<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 6/06/2019
 * Time: 1:43 PM
 */


namespace views\forms\tickets;


use utilities\InfoCentralConnection;
use views\forms\Form;

class TicketForm extends Form
{
    /**
     * TicketForm constructor.
     * @param int $workspace
     * @param array|null $details
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct(int $workspace, ?array $details = NULL)
    {
        $this->setTemplateFromHTML('tickets/TicketForm', self::TEMPLATE_FORM);

        if($details !== NULL)
            $this->setVariables($details);

        $attributeTypes = array('status', 'closureCode', 'category', 'type', 'severity');

        foreach($attributeTypes as $attributeType)
        {
            $attributes = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'tickets/workspaces/' . $workspace . '/attributes/' . $attributeType)->getBody();

            $select = '';

            foreach($attributes as $attribute)
            {
                $selected = '';

                if(isset($details[$attributeType]) AND $details[$attributeType] = $attribute['code'])
                    $selected = ' selected';

                $select .= "<option value='{$attribute['code']}' {$selected}>{$attribute['name']}</option>";
            }

            $this->setVariable($attributeType . 'Select', $select);
        }
    }
}
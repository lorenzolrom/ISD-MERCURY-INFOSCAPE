<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 4:43 PM
 */


namespace views\forms\netcenter\web;


use utilities\InfoCentralConnection;
use views\forms\Form;

class VHostForm extends Form
{
    /**
     * VHostForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('web/VHostForm', self::TEMPLATE_FORM);

        $statuses = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'vhosts/statuses')->getBody();
        $statusSelect = "";

        foreach($statuses as $status)
        {

            $selected = ($details['status'] == $status['code']) ? 'selected' : '';

            $statusSelect .= "<option value='{$status['code']}' $selected>{$status['name']}</option>\n";
        }

        $this->setVariable('statusSelect', $statusSelect);

        if($details !== NULL)
            $this->setVariables($details);
    }
}
<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/11/2020
 * Time: 7:04 PM
 */


namespace extensions\cliff\views\forms;


use utilities\InfoCentralConnection;
use views\forms\Form;

class KeyForm extends Form
{
    /**
     * KeyForm constructor.
     * @param array|null $details
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('KeyForm', self::TEMPLATE_FORM, 'cliff');
        $systems = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'locksystems')->getBody();
        $select = '';

        foreach($systems as $system)
        {
            $selected = '';

            if(isset($details['systemCode']) AND ($details['systemCode'] == $system['code']))
                $selected = ' selected';

            $select .= "<option value='{$system['code']}' $selected>{$system['code']} - {$system['name']}</option>";
        }

        $this->setVariable('systemSelect', $select);

        if($details !== NULL)
        {
            $this->setVariables($details);
        }
    }
}

<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/02/2019
 * Time: 9:27 PM
 */


namespace extensions\netuserman\views\forms;


use views\forms\Form;

class CreateUserForm extends Form
{
    /**
     * CreateUserForm constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('CreateUserForm', self::TEMPLATE_FORM, 'netuserman');

        $useraccountcontrolOptions = '';

        foreach(array_keys(EditUserForm::UAC_FORWARD_LOOKUP) as $flag)
        {
            $useraccountcontrolOptions .= "<option value='$flag'>$flag</option>";
        }

        $this->setVariable('useraccountcontrolOptions', $useraccountcontrolOptions);
    }
}

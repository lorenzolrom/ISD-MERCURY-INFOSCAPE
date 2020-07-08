<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 8:38 PM
 */


namespace extensions\netuserman\views\forms;


use views\forms\Form;

class EditGroupForm extends Form
{

    /**
     * EditUserForm constructor.
     * @param array|null $vars
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $vars = NULL)
    {
        $this->setTemplateFromHTML('EditGroupForm', self::TEMPLATE_FORM, 'netuserman');

        if($vars !== NULL)
            $this->setVariables($vars);
    }
}

<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/13/2019
 * Time: 12:02 PM
 */


namespace views\forms\lockshop;


use views\forms\Form;

class SystemForm extends Form
{
    /**
     * SystemForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('lockshop/SystemForm', Form::TEMPLATE_FORM);

        if(is_array($details))
            $this->setVariables($details);
    }
}
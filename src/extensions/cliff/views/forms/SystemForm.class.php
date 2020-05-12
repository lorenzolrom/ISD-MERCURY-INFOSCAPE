<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 5/11/2020
 * Time: 1:09 PM
 */


namespace extensions\cliff\views\forms;


use views\forms\Form;

class SystemForm extends Form
{
    /**
     * SystemCreateForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('SystemForm', self::TEMPLATE_FORM, 'cliff');

        if($details !== NULL)
            $this->setVariables($details);
    }
}
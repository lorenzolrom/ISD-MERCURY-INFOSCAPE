<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/17/2019
 * Time: 12:55 PM
 */


namespace views\forms\lockshop;


use views\forms\Form;

class CoreForm extends Form
{
    /**
     * CoreForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('lockshop/CoreForm', self::TEMPLATE_FORM);

        if($details !== NULL)
            $this->setVariables($details);
    }
}
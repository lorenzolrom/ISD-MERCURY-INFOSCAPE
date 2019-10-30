<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 9:38 PM
 */


namespace extensions\netcenter\views\forms\web;


use views\forms\Form;

class URLAliasForm extends Form
{
    /**
     * URLAliasForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('web/URLAliasForm', self::TEMPLATE_FORM, 'netcenter');

        if($details !== NULL)
        {
            $this->setVariables($details);

            if($details['disabled'] == 1)
                $this->setVariable('disabledYes', 'selected');
        }

    }
}
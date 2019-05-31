<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 1:13 PM
 */


namespace views\forms\inventory;


use views\forms\Form;

class DiscardOrderForm extends Form
{
    /**
     * DiscardOrderForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('inventory/DiscardOrderForm', self::TEMPLATE_FORM);

        if($details !== NULL)
            $this->setVariables($details);
    }
}
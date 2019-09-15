<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 12:24 PM
 */


namespace views\forms\tickets;


use views\forms\Form;

class RequestUpdateForm extends Form
{
    /**
     * RequestUpdateForm constructor.
     * @param array $details
     * @throws \exceptions\ViewException
     */
    public function __construct(array $details)
    {
        $this->setTemplateFromHTML('tickets/TicketForm', self::TEMPLATE_FORM);

        $this->setVariables($details);
    }
}
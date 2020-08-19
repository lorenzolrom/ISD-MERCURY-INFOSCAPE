<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 12:24 PM
 */


namespace extensions\tickets\views\forms;


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
        $this->setTemplateFromHTML('TicketForm', self::TEMPLATE_FORM, 'tickets');

        $this->setVariables($details);
    }
}

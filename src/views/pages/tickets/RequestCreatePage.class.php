<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 12:57 PM
 */


namespace views\pages\tickets;


use views\forms\tickets\RequestCreateForm;

class RequestCreatePage extends TicketDocument
{
    /**
     * RequestCreatePage constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     * @throws \exceptions\SecurityException
     */
    public function __construct()
    {
        // Verify user is in workspace
        parent::__construct('tickets-customer', 'requests');

        $this->setVariable('tabTitle', 'Create New Request');
        $form = new RequestCreateForm();

        $this->setVariable('content', $form->getTemplate());
    }
}
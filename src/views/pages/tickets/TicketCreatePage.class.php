<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/06/2019
 * Time: 1:45 PM
 */


namespace views\pages\tickets;


use views\forms\tickets\TicketForm;

class TicketCreatePage extends ModelPage
{
    /**
     * TicketCreatePage constructor.
     * @param int $workspace
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(int $workspace)
    {
        // Verify user is in workspace
        parent::__construct('tickets/workspaces/' . $workspace, 'tickets-agent', 'agent');

        $this->setVariable('tabTitle', 'Create New Ticket');
        $form = new TicketForm($workspace);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('workspace', $this->response->getBody()['name']);
        $this->setVariable('cancelLink', 'javascript: close();');
        $this->setVariable('formScript', 'return create()');
    }
}
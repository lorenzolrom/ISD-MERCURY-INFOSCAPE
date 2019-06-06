<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 6/06/2019
 * Time: 8:16 AM
 */


namespace views\pages\tickets;


use views\forms\tickets\WorkspaceSelectForm;

class WorkspaceSelectPage extends TicketDocument
{
    public function __construct()
    {
        parent::__construct('tickets-agent');

        $form = new WorkspaceSelectForm();

        $this->setVariable('tabTitle', 'Select Workspace');
        $this->setVariable('content', $form->getTemplate());
    }
}
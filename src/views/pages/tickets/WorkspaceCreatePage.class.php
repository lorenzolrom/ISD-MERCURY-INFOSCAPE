<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 8:06 AM
 */


namespace views\pages\tickets;


use views\forms\tickets\WorkspaceForm;

class WorkspaceCreatePage extends TicketDocument
{
    public function __construct()
    {
        parent::__construct('tickets-admin');
        $this->setVariable('tabTitle', 'Workspaces (New)');

        $form = new WorkspaceForm();
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('cancelLink', '{{@baseURI}}tickets/admin/workspaces');
        $this->setVariable('formScript', 'return create()');
    }
}
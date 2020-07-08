<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/06/2019
 * Time: 8:16 AM
 */


namespace extensions\tickets\views\pages;


use extensions\tickets\views\forms\WorkspaceSelectForm;

class WorkspaceSelectPage extends TicketDocument
{
    public function __construct()
    {
        parent::__construct('tickets-agent', 'agent');

        $form = new WorkspaceSelectForm();

        $this->setVariable('tabTitle', 'Select Workspace');
        $this->setVariable('content', $form->getTemplate());
    }
}

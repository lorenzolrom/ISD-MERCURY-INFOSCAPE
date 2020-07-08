<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 9/01/2019
 * Time: 1:32 PM
 */


namespace extensions\tickets\views\pages;


use extensions\tickets\views\forms\TicketForm;

class TicketEditPage extends PopupModelPage
{
    public function __construct(?string $number)
    {
        parent::__construct('tickets/workspaces/' . (int)$_COOKIE['ML_agentWorkspace'] . '/tickets/' . $number . '/edit');

        $details = $this->response->getBody();

        if($details['locked'] == 'yes')
        {
            $this->setVariable('content', self::templateFileContents('TicketLockedPage', self::TEMPLATE_PAGE, 'tickets'));
        }
        else
        {
            $form = new TicketForm((int)$_COOKIE['ML_agentWorkspace'], $details);
            $this->setVariable('content', $form->getTemplate());
            $this->setVariable('cancelLink', '{{@baseURI}}tickets/agent/' . $number);
            $this->setVariable('formScript', "return update('$number');");
            $this->setVariable('lock_script', "<script src=\"{{@baseURI}}scripts/tickets/tickets.js\"></script>");
        }
        $this->setVariable('tabTitle', 'Editing Ticket #' . $number);
        $this->setVariables($details);
    }
}

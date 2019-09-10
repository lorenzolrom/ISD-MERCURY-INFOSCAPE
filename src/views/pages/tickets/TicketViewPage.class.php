<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/01/2019
 * Time: 9:20 AM
 */


namespace views\pages\tickets;


class TicketViewPage extends ModelPage
{
    public function __construct(?string $number)
    {
        // Workspace number from cookie

        parent::__construct('tickets/workspaces/' . (int)$_COOKIE['ML_agentWorkspace']. '/tickets/' . $number, 'tickets-agent', 'agent');

        $details = $this->response->getBody();

        $this->setVariable('content', self::templateFileContents('tickets/TicketViewPage', self::TEMPLATE_PAGE));
        $this->setVariable('tabTitle', 'View Ticket #' . $number);
        $this->setVariables($details);
    }
}
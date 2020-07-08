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
 * Time: 9:20 AM
 */


namespace extensions\tickets\views\pages;


class TicketViewPage extends PopupModelPage
{
    public function __construct(?string $number)
    {
        // Workspace number from cookie

        parent::__construct('tickets/workspaces/' . (int)$_COOKIE['ML_agentWorkspace']. '/tickets/' . $number);

        $details = $this->response->getBody();

        $this->setVariable('content', self::templateFileContents('TicketViewPage', self::TEMPLATE_PAGE, 'tickets'));

        if($details['locked'] == 'yes')
        {
            $this->setVariable('lockedMessage', "This ticket has been locked by {$details['lockedBy']} and is still locked as of {$details['lockedTime']}.");
        }

        $this->setVariable('tabTitle', 'View Ticket #' . $number);
        $this->setVariables($details);
    }
}

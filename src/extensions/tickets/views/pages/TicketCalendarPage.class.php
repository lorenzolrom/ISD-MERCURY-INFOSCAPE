<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 9/16/2019
 * Time: 12:37 PM
 */


namespace extensions\tickets\views\pages;


class TicketCalendarPage extends ModelPage
{
    public function __construct(string $id)
    {
        parent::__construct('tickets/workspaces/' . $id, 'tickets-agent', 'agent');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Scheduled Ticket Calendar');
        $this->setVariable('content', self::templateFileContents('TicketCalendarPage', self::TEMPLATE_PAGE, 'tickets'));
        $this->setVariable('workspace', $details['name']);
    }
}

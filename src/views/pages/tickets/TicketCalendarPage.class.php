<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/16/2019
 * Time: 12:37 PM
 */


namespace views\pages\tickets;


class TicketCalendarPage extends ModelPage
{
    public function __construct(string $id)
    {
        parent::__construct('tickets/workspaces/' . $id, 'tickets-agent', 'agent');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Scheduled Ticket Calendar');
        $this->setVariable('content', self::templateFileContents('tickets/TicketCalendarPage', self::TEMPLATE_PAGE));
        $this->setVariable('workspace', $details['name']);
    }
}
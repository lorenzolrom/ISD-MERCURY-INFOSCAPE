<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 8:30 AM
 */


namespace views\pages\tickets;


class RequestPage extends TicketDocument
{
    public function __construct()
    {
        parent::__construct('tickets-customer', 'requests');

        $this->setVariable('content', self::templateFileContents('tickets/RequestPage', self::TEMPLATE_PAGE));
        $this->setVariable('tabTitle', 'Requests');
    }
}
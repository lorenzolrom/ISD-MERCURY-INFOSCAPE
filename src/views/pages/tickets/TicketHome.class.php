<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:08 PM
 */


namespace views\pages\tickets;


class TicketHome extends TicketDocument
{
    public function __construct()
    {
        parent::__construct('tickets');
        $this->setVariable('tabTitle', 'Service Center');

        $this->setVariable('content', self::templateFileContents('tickets/TicketHome', self::TEMPLATE_PAGE));
    }
}
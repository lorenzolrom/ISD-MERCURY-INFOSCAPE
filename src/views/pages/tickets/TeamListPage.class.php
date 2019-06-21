<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 8:47 AM
 */


namespace views\pages\tickets;


class TeamListPage extends TicketDocument
{
    public function __construct()
    {
        parent::__construct('tickets-admin', 'admin');
        $this->setVariable('tabTitle', 'Teams');

        $this->setVariable('content', self::templateFileContents('tickets/TeamListPage', self::TEMPLATE_PAGE));
    }
}
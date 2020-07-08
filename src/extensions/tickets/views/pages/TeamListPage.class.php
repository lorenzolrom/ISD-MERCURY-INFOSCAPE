<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 8:47 AM
 */


namespace extensions\tickets\views\pages;


class TeamListPage extends TicketDocument
{
    public function __construct()
    {
        parent::__construct('tickets-admin', 'admin');
        $this->setVariable('tabTitle', 'Teams');

        $this->setVariable('content', self::templateFileContents('TeamListPage', self::TEMPLATE_PAGE, 'tickets'));
    }
}

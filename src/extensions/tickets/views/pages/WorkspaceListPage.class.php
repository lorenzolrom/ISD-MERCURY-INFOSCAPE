<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 7:53 AM
 */


namespace extensions\tickets\views\pages;

class WorkspaceListPage extends TicketDocument
{
    /**
     * WorkspaceListPage constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct('tickets-admin', 'admin');
        $this->setVariable('tabTitle', 'Workspaces');

        $this->setVariable('content', self::templateFileContents('WorkspaceListPage', self::TEMPLATE_PAGE, 'tickets'));
    }
}

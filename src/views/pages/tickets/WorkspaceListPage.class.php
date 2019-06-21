<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 7:53 AM
 */


namespace views\pages\tickets;

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

        $this->setVariable('content', self::templateFileContents('tickets/WorkspaceListPage', self::TEMPLATE_PAGE));
    }
}
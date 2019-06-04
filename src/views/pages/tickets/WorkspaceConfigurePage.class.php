<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 6/04/2019
 * Time: 8:23 AM
 */


namespace views\pages\tickets;


class WorkspaceConfigurePage extends ModelPage
{
    public function __construct(?string $id)
    {
        parent::__construct("tickets/workspaces/$id", 'tickets-admin');
        $details = $this->response->getBody();

        $this->setVariable('content', self::templateFileContents('tickets/WorkspaceConfigurePage', self::TEMPLATE_PAGE));

        $this->setVariable('tabTitle', 'Workspace - ' . $details['name'] . ' (Configure)');
        $this->setVariable('id', $id);
    }
}
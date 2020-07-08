<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/04/2019
 * Time: 8:23 AM
 */


namespace extensions\tickets\views\pages;


class WorkspaceConfigurePage extends ModelPage
{
    public function __construct(?string $id)
    {
        parent::__construct("tickets/workspaces/$id", 'tickets-admin', 'admin');
        $details = $this->response->getBody();

        $this->setVariable('content', self::templateFileContents('WorkspaceConfigurePage', self::TEMPLATE_PAGE, 'tickets'));

        $this->setVariable('tabTitle', 'Workspace - ' . $details['name'] . ' (Configure)');
        $this->setVariable('id', $id);
    }
}

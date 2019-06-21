<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/06/2019
 * Time: 8:12 AM
 */


namespace views\pages\tickets;

/**
 * Class Workspace
 *
 * Agent dashboard for selected workspace
 *
 * @package views\pages\tickets
 */
class WorkspacePage extends ModelPage
{
    /**
     * WorkspacePage constructor.
     * @param string $id
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(string $id)
    {
        parent::__construct('tickets/workspaces/' . $id, 'tickets-agent', 'agent');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Service Desk');
        $this->setVariable('content', self::templateFileContents('tickets/WorkspacePage', self::TEMPLATE_PAGE));
        $this->setVariable('workspace', $details['name']);
    }
}
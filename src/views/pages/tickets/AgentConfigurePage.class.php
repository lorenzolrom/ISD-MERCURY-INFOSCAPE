<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 9:17 PM
 */


namespace views\pages\tickets;


class AgentConfigurePage extends ModelPage
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

        $this->setVariable('tabTitle', 'Configure Widgets');
        $this->setVariable('content', self::templateFileContents('tickets/AgentConfigurePage', self::TEMPLATE_PAGE));
        $this->setVariable('workspace', $details['name']);
    }
}
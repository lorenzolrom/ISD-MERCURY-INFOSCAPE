<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/13/2019
 * Time: 1:26 PM
 */


namespace views\pages\tickets;


class MySearchesPage extends ModelPage
{
    public function __construct(string $id)
    {
        parent::__construct('tickets/workspaces/' . $id, 'tickets-agent', 'agent');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'My Searches');
        $this->setVariable('content', self::templateFileContents('tickets/MySearchesPage', self::TEMPLATE_PAGE));
        $this->setVariable('workspace', $details['name']);
    }
}
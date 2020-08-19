<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 9/13/2019
 * Time: 1:26 PM
 */


namespace extensions\tickets\views\pages;


class MySearchesPage extends ModelPage
{
    public function __construct(string $id)
    {
        parent::__construct('tickets/workspaces/' . $id, 'tickets-agent', 'agent');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'My Searches');
        $this->setVariable('content', self::templateFileContents('MySearchesPage', self::TEMPLATE_PAGE, 'tickets'));
        $this->setVariable('workspace', $details['name']);
    }
}

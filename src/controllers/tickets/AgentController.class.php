<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/06/2019
 * Time: 8:19 AM
 */


namespace controllers\tickets;


use controllers\Controller;
use views\pages\tickets\TicketCreatePage;
use views\pages\tickets\WorkspacePage;
use views\pages\tickets\WorkspaceSelectPage;
use views\View;

class AgentController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\EntryNotFoundException
     */
    public function getPage(): ?View
    {
        // Cannot proceed without selecting workspace
        if(!isset($_COOKIE['ML_agentWorkspace']))
            return new WorkspaceSelectPage();

        switch($this->request->next())
        {
            case NULL:
                return new WorkspacePage((string)$_COOKIE['ML_agentWorkspace']);
            case 'new':
                return new TicketCreatePage((int)$_COOKIE['ML_agentWorkspace']);
            case 'search':
                die('search');
            default:
                die('view');
        }
    }
}
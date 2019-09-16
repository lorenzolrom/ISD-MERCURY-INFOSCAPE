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
use views\pages\tickets\AgentConfigurePage;
use views\pages\tickets\MySearchesPage;
use views\pages\tickets\TicketCalendarPage;
use views\pages\tickets\TicketCreatePage;
use views\pages\tickets\TicketEditPage;
use views\pages\tickets\TicketSearchPage;
use views\pages\tickets\TicketViewPage;
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

        $param = $this->request->next();
        $action = $this->request->next();

        switch($param)
        {
            case NULL:
                return new WorkspacePage((string)$_COOKIE['ML_agentWorkspace']);
            case 'configure':
                return new AgentConfigurePage((string)$_COOKIE['ML_agentWorkspace']);
            case 'calendar':
                return new TicketCalendarPage((string)$_COOKIE['ML_agentWorkspace']);
            case 'new':
                return new TicketCreatePage((int)$_COOKIE['ML_agentWorkspace']);
            case 'search':
                if($action == 'saved')
                    return new MySearchesPage((int)$_COOKIE['ML_agentWorkspace']);
                return new TicketSearchPage((int)$_COOKIE['ML_agentWorkspace'], $this->request->next() !== NULL ? TRUE : FALSE);
            default:
                if($action == 'edit')
                    return new TicketEditPage((int)$param);
                return new TicketViewPage((int)$param);
        }
    }
}
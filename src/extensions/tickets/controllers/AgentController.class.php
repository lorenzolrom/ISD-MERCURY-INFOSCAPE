<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/06/2019
 * Time: 8:19 AM
 */


namespace extensions\tickets\controllers;


use controllers\Controller;
use extensions\tickets\views\pages\AgentConfigurePage;
use extensions\tickets\views\pages\MySearchesPage;
use extensions\tickets\views\pages\TicketCalendarPage;
use extensions\tickets\views\pages\TicketCreatePage;
use extensions\tickets\views\pages\TicketEditPage;
use extensions\tickets\views\pages\TicketSearchPage;
use extensions\tickets\views\pages\TicketViewPage;
use extensions\tickets\views\pages\WorkspacePage;
use extensions\tickets\views\pages\WorkspaceSelectPage;
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
        // Check for workspace provided as cookie
        if(isset($_GET['w']))
        {
            setcookie('ML_agentWorkspace', (int)$_GET['w'], 0, \Config::OPTIONS['baseURI']);

            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                $link = "https";
            else
                $link = "http";

            $link .= '://';

            header('Location: ' . $link . $_SERVER['HTTP_HOST'] . explode('?', $_SERVER['REQUEST_URI'])[0]);
            exit;
        }

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

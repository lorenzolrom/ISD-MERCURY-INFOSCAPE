<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:10 PM
 */


namespace extensions\tickets\controllers;


use controllers\Controller;
use extensions\tickets\views\pages\TicketHome;
use views\View;

class TicketController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\ParameterException
     */
    public function getPage(): ?View
    {
        switch($this->request->next())
        {
            case 'admin':
                $a = new AdminController($this->request);
                return $a->getPage();
            case 'agent':
                $a = new AgentController($this->request);
                return $a->getPage();
            case 'requests':
                $r = new RequestController($this->request);
                return $r->getPage();
            case NULL:
                return new TicketHome();
        }

        return NULL;
    }
}
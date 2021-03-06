<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 7:48 AM
 */


namespace extensions\tickets\controllers;


use controllers\Controller;
use views\View;

class AdminController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        switch($this->request->next())
        {
            case 'workspaces':
                $w = new WorkspaceController($this->request);
                return $w->getPage();
            case 'teams':
                $t = new TeamController($this->request);
                return $t->getPage();
        }

        return NULL;
    }
}

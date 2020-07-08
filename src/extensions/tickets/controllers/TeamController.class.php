<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 8:48 AM
 */


namespace extensions\tickets\controllers;


use controllers\Controller;
use extensions\tickets\views\pages\TeamCreatePage;
use extensions\tickets\views\pages\TeamEditPage;
use extensions\tickets\views\pages\TeamListPage;
use views\View;

class TeamController extends Controller
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
        $param = $this->request->next();
        switch($param)
        {
            case null:
                return new TeamListPage();
            case 'new':
                return new TeamCreatePage();
            default:
                return new TeamEditPage($param);
        }
    }
}

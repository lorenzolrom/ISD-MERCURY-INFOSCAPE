<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 8:48 AM
 */


namespace controllers\tickets;


use controllers\Controller;
use views\pages\tickets\TeamCreatePage;
use views\pages\tickets\TeamEditPage;
use views\pages\tickets\TeamListPage;
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
    public function getPage(): View
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
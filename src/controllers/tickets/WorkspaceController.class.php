<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 7:47 AM
 */


namespace controllers\tickets;


use controllers\Controller;
use views\pages\tickets\WorkspaceConfigurePage;
use views\pages\tickets\WorkspaceCreatePage;
use views\pages\tickets\WorkspaceEditPage;
use views\pages\tickets\WorkspaceListPage;
use views\View;

class WorkspaceController extends Controller
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
                return new WorkspaceListPage();
            case 'new':
                return new WorkspaceCreatePage();
            default:
                if($this->request->next() === 'configure')
                    return new WorkspaceConfigurePage($param);
                return new WorkspaceEditPage($param);
        }
    }
}
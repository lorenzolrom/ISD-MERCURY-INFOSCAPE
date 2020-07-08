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
 * Time: 7:47 AM
 */


namespace extensions\tickets\controllers;


use controllers\Controller;
use extensions\tickets\views\pages\WorkspaceConfigurePage;
use extensions\tickets\views\pages\WorkspaceCreatePage;
use extensions\tickets\views\pages\WorkspaceEditPage;
use extensions\tickets\views\pages\WorkspaceListPage;
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

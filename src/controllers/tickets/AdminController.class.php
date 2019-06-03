<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 7:48 AM
 */


namespace controllers\tickets;


use controllers\Controller;
use exceptions\PageNotFoundException;
use views\View;

class AdminController extends Controller
{

    /**
     * @return View
     * @throws PageNotFoundException
     */
    public function getPage(): View
    {
        switch($this->request->next())
        {
            case 'workspaces':
                $w = new WorkspaceController($this->request);
                return $w->getPage();
        }

        throw new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND);
    }
}
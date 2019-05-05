<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 4:34 PM
 */


namespace controllers\admin;


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
        $param = $this->request->next();

        switch($param)
        {
            case 'bulletins':
                $bulletins = new BulletinController($this->request);
                return $bulletins->getPage();
        }

        throw new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND);
    }
}
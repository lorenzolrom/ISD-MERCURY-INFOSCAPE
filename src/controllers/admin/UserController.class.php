<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 11:54 AM
 */


namespace controllers\admin;


use controllers\Controller;
use views\pages\admin\MainCreatePage;
use views\pages\admin\UserEditPage;
use views\pages\admin\MainSearchPage;
use views\View;

class UserController extends Controller
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
                return new MainSearchPage();
            case 'new':
                return new MainCreatePage();
            default:
                return new UserEditPage($param);
        }
    }
}
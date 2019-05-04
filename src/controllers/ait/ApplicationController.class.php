<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/03/2019
 * Time: 8:22 PM
 */


namespace controllers\ait;


use controllers\Controller;
use views\pages\ait\ApplicationSearchPage;
use views\View;

class ApplicationController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): View
    {
        $param = $this->request->next();

        switch($param)
        {
            case null:
                return new ApplicationSearchPage();
            case 'new':
                die('new');
            default:
                die('edit');
        }
    }
}
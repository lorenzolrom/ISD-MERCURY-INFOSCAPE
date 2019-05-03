<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/01/2019
 * Time: 6:57 AM
 */


namespace controllers\web;


use controllers\Controller;
use views\pages\web\VHostCreatePage;
use views\pages\web\VHostEditPage;
use views\pages\web\VHostSearchPage;
use views\View;

class VHostController extends Controller
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
                return new VHostSearchPage();
            case 'new':
                return new VHostCreatePage();
            default:
                return new VHostEditPage($param);
        }
    }
}
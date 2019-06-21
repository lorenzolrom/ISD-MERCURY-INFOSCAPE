<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 8:09 PM
 */


namespace controllers\web;


use controllers\Controller;
use views\pages\netcenter\web\RegistrarCreatePage;
use views\pages\netcenter\web\RegistrarEditPage;
use views\pages\netcenter\web\RegistrarListPage;
use views\View;

class RegistrarController extends Controller
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
                return new RegistrarListPage();
            case 'new':
                return new RegistrarCreatePage();
            default:
                return new RegistrarEditPage($param);
        }
    }
}
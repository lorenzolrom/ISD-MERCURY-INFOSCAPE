<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 9:50 PM
 */


namespace controllers\netcenter\web;


use controllers\Controller;
use views\pages\netcenter\web\URLAliasCreatePage;
use views\pages\netcenter\web\URLAliasEditPage;
use views\pages\netcenter\web\URLAliasSearchPage;
use views\View;

class URLAliasController extends Controller
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
                return new URLAliasSearchPage();
            case 'new':
                return new URLAliasCreatePage();
            default:
                return new URLAliasEditPage($param);
        }
    }
}
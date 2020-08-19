<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 9:50 PM
 */


namespace extensions\netcenter\controllers\web;


use controllers\Controller;
use extensions\netcenter\views\pages\web\URLAliasCreatePage;
use extensions\netcenter\views\pages\web\URLAliasEditPage;
use extensions\netcenter\views\pages\web\URLAliasSearchPage;
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

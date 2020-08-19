<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/01/2019
 * Time: 6:57 AM
 */


namespace extensions\netcenter\controllers\web;


use controllers\Controller;
use extensions\netcenter\views\pages\web\VHostCreatePage;
use extensions\netcenter\views\pages\web\VHostEditPage;
use extensions\netcenter\views\pages\web\VHostSearchPage;
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
    public function getPage(): ?View
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

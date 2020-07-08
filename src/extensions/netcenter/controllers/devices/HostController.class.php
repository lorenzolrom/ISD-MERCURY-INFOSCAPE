<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 8:42 PM
 */


namespace extensions\netcenter\controllers\devices;


use controllers\Controller;
use extensions\netcenter\views\pages\devices\HostCreatePage;
use extensions\netcenter\views\pages\devices\HostEditPage;
use extensions\netcenter\views\pages\devices\HostSearchPage;
use views\View;

class HostController extends Controller
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
                return new HostSearchPage();
            case 'new':
                return new HostCreatePage();
            default:
                return new HostEditPage($param);
        }
    }
}

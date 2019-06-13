<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 8:42 PM
 */


namespace controllers\devices;


use controllers\Controller;
use views\pages\devices\HostCreatePage;
use views\pages\devices\HostEditPage;
use views\pages\devices\HostSearchPage;
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
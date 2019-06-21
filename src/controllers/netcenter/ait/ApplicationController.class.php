<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 5/03/2019
 * Time: 8:22 PM
 */


namespace controllers\netcenter\ait;


use controllers\Controller;
use views\pages\netcenter\ait\ApplicationCreatePage;
use views\pages\netcenter\ait\ApplicationEditPage;
use views\pages\netcenter\ait\ApplicationSearchPage;
use views\pages\netcenter\ait\ApplicationViewPage;
use views\View;

class ApplicationController extends Controller
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
                return new ApplicationSearchPage();
            case 'new':
                return new ApplicationCreatePage();
            default:
                switch($this->request->next())
                {
                    case 'edit':
                        return new ApplicationEditPage($param);
                    default:
                        return new ApplicationViewPage($param);
                }
        }
    }
}
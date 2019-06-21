<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 1:31 AM
 */


namespace controllers\netcenter\monitor;


use controllers\Controller;
use views\pages\netcenter\monitor\HostCategoryCreatePage;
use views\pages\netcenter\monitor\HostCategoryEditPage;
use views\pages\netcenter\monitor\HostCategoryListPage;
use views\pages\netcenter\monitor\HostMonitor;
use views\View;

class MonitorController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        switch($this->request->next())
        {
            case null:
                return new HostMonitor();
            case 'configure':
                $next = $this->request->next();
                switch($next)
                {
                    case null:
                        return new HostCategoryListPage();
                    case 'new':
                        return new HostCategoryCreatePage();
                    default:
                        return new HostCategoryEditPage($next);
                }
        }

        return NULL;
    }
}
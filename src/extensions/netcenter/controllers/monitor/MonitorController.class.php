<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 1:31 AM
 */


namespace extensions\netcenter\controllers\monitor;


use controllers\Controller;
use extensions\netcenter\views\pages\monitor\HostCategoryCreatePage;
use extensions\netcenter\views\pages\monitor\HostCategoryEditPage;
use extensions\netcenter\views\pages\monitor\HostCategoryListPage;
use extensions\netcenter\views\pages\monitor\HostMonitor;
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

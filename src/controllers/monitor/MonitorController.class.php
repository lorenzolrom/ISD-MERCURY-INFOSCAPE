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


namespace controllers\monitor;


use controllers\Controller;
use exceptions\PageNotFoundException;
use views\pages\monitor\HostCategoryCreatePage;
use views\pages\monitor\HostCategoryEditPage;
use views\pages\monitor\HostCategoryListPage;
use views\pages\monitor\HostMonitor;
use views\View;

class MonitorController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws PageNotFoundException
     * @throws \exceptions\EntryNotFoundException
     */
    public function getPage(): View
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

        throw new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND);
    }
}
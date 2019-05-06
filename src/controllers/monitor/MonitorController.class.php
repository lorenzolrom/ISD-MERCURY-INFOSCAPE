<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 1:31 AM
 */


namespace controllers\monitor;


use controllers\Controller;
use views\pages\monitor\HostMonitor;
use views\View;

class MonitorController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): View
    {
        switch($this->request->next())
        {
            case null:
                return new HostMonitor();
            case 'configure':
                die('configure'); // TODO: implement configuration
        }
    }
}
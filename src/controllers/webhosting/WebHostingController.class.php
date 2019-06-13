<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:22 PM
 */


namespace controllers\webhosting;


use controllers\Controller;
use exceptions\PageNotFoundException;
use views\pages\webhosting\WebHostingHome;
use views\View;

class WebHostingController extends Controller
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
            case NULL:
                return new WebHostingHome();
        }

        return NULL;
    }
}
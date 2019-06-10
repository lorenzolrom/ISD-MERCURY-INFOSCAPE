<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/24/2019
 * Time: 3:34 PM
 */


namespace controllers\lockshop;


use controllers\Controller;
use exceptions\PageNotFoundException;
use views\pages\lockshop\LIMSErrorPage;
use views\pages\lockshop\LIMSHome;
use views\View;

class LockShopController extends Controller
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
                return new LIMSHome();
        }

        return new LIMSErrorPage(new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND));
    }
}
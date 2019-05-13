<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:10 PM
 */


namespace controllers\tickets;


use controllers\Controller;
use exceptions\PageNotFoundException;
use views\pages\tickets\TicketErrorPage;
use views\pages\tickets\TicketHome;
use views\View;

class TicketController extends Controller
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
                return new TicketHome();
        }

        return new TicketErrorPage(new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND));
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 12:50 PM
 */


namespace controllers\inventory;


use controllers\Controller;
use views\pages\inventory\DiscardOrderCreatePage;
use views\pages\inventory\DiscardOrderEditPage;
use views\pages\inventory\DiscardOrderSearchPage;
use views\pages\inventory\DiscardOrderViewPage;
use views\View;

class DiscardOrderController extends Controller
{
    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\EntryNotFoundException
     */
    public function getPage(): View
    {
        $param = $this->request->next();

        switch($param)
        {
            case null:
                return new DiscardOrderSearchPage();
            case 'new':
                return new DiscardOrderCreatePage();
            default:
                if($this->request->next() === 'edit')
                    return new DiscardOrderEditPage($param);
                return new DiscardOrderViewPage($param);
        }
    }
}
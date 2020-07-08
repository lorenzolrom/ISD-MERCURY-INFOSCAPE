<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/08/2019
 * Time: 12:11 PM
 */


namespace controllers;


use views\pages\InboxPage;
use views\pages\InboxViewPage;
use views\View;

class InboxController extends Controller
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
                return new InboxPage();
            default:
                return new InboxViewPage($param);
        }
    }
}

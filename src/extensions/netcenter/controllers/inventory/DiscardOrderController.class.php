<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 12:50 PM
 */


namespace extensions\netcenter\controllers\inventory;


use controllers\Controller;
use extensions\netcenter\views\pages\inventory\DiscardOrderCreatePage;
use extensions\netcenter\views\pages\inventory\DiscardOrderEditPage;
use extensions\netcenter\views\pages\inventory\DiscardOrderSearchPage;
use extensions\netcenter\views\pages\inventory\DiscardOrderViewPage;
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
    public function getPage(): ?View
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

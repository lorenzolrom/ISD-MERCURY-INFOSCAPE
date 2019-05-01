<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 3:43 PM
 */


namespace controllers\inventory;


use controllers\Controller;
use views\pages\inventory\CommodityCreatePage;
use views\pages\inventory\CommodityEditPage;
use views\pages\inventory\CommoditySearchPage;
use views\View;

class CommodityController extends Controller
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
                return new CommoditySearchPage();
            case "new":
                return new CommodityCreatePage();
            default:
                return new CommodityEditPage($param);
        }
    }
}
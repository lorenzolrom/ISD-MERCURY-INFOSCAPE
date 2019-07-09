<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 3:43 PM
 */


namespace controllers\netcenter\inventory;


use controllers\Controller;
use views\pages\netcenter\inventory\CommodityCreatePage;
use views\pages\netcenter\inventory\CommodityEditPage;
use views\pages\netcenter\inventory\CommoditySearchPage;
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
    public function getPage(): ?View
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
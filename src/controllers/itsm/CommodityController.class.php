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


namespace controllers\itsm;


use controllers\Controller;
use views\pages\itsm\CommodityCreatePage;
use views\pages\itsm\CommodityEditPage;
use views\pages\itsm\CommoditySearchPage;
use views\pages\itsm\CommodityViewPage;
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
                switch($this->request->next())
                {
                    case "edit":
                        return new CommodityEditPage($param);
                }
                return new CommodityViewPage($param);
        }
    }
}
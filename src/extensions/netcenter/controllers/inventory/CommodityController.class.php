<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 3:43 PM
 */


namespace extensions\netcenter\controllers\inventory;


use controllers\Controller;
use extensions\netcenter\views\pages\inventory\CommodityCreatePage;
use extensions\netcenter\views\pages\inventory\CommodityEditPage;
use extensions\netcenter\views\pages\inventory\CommoditySearchPage;
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

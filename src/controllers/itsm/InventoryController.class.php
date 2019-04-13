<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 3:44 PM
 */


namespace controllers\itsm;


use controllers\Controller;
use exceptions\PageNotFoundException;
use views\View;

class InventoryController extends Controller
{

    /**
     * @return View
     * @throws PageNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\EntryNotFoundException
     */
    public function getPage(): View
    {
        switch($this->request->next())
        {
            case "commodities":
                $commodity = new CommodityController($this->request);
                return $commodity->getPage();
            case "assettypes":
                $assetTypes = new AssetTypeController($this->request);
                return $assetTypes->getPage();
        }

        throw new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND);
    }
}
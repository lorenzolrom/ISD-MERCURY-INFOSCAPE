<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 3:44 PM
 */


namespace controllers\inventory;


use controllers\Controller;
use exceptions\PageNotFoundException;
use views\View;

class InventoryController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): View
    {
        switch($this->request->next())
        {
            case "assets":
                $asset = new AssetController($this->request);
                return $asset->getPage();
            case "commodities":
                $commodity = new CommodityController($this->request);
                return $commodity->getPage();
            case "assettypes":
                $assetTypes = new AssetTypeController($this->request);
                return $assetTypes->getPage();
            case 'warehouses':
                $warehouses = new WarehouseController($this->request);
                return $warehouses->getPage();
            case 'vendors':
                $vendors = new VendorController($this->request);
                return $vendors->getPage();
            case 'purchaseorders':
                $po = new PurchaseOrderController($this->request);
                return $po->getPage();
            case 'discards':
                $do = new DiscardOrderController($this->request);
                return $do->getPage();
        }

        return NULL;
    }
}
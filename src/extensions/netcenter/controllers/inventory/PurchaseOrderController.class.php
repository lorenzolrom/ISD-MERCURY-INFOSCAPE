<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/10/2019
 * Time: 2:12 PM
 */


namespace extensions\netcenter\controllers\inventory;


use controllers\Controller;
use extensions\netcenter\views\pages\inventory\PurchaseOrderCreatePage;
use extensions\netcenter\views\pages\inventory\PurchaseOrderEditPage;
use extensions\netcenter\views\pages\inventory\PurchaseOrderSearchPage;
use extensions\netcenter\views\pages\inventory\PurchaseOrderViewPage;
use views\View;

class PurchaseOrderController extends Controller
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
                return new PurchaseOrderSearchPage();
            case 'new':
                return new PurchaseOrderCreatePage();
            default:
                if($this->request->next() === 'edit')
                    return new PurchaseOrderEditPage($param);
                return new PurchaseOrderViewPage($param);
        }
    }
}
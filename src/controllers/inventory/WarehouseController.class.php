<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/14/2019
 * Time: 10:53 AM
 */


namespace controllers\inventory;


use controllers\Controller;
use views\pages\inventory\WarehouseCreatePage;
use views\pages\inventory\WarehouseEditPage;
use views\pages\inventory\WarehouseListPage;
use views\View;

class WarehouseController extends Controller
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
                return new WarehouseListPage();
            case 'new':
                return new WarehouseCreatePage();
            default:
                return new WarehouseEditPage($param);
        }
    }
}
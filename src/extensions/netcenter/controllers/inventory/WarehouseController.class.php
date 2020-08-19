<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/14/2019
 * Time: 10:53 AM
 */


namespace extensions\netcenter\controllers\inventory;


use controllers\Controller;
use extensions\netcenter\views\pages\inventory\WarehouseCreatePage;
use extensions\netcenter\views\pages\inventory\WarehouseEditPage;
use extensions\netcenter\views\pages\inventory\WarehouseListPage;
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
    public function getPage(): ?View
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

<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/25/2019
 * Time: 11:34 AM
 */


namespace extensions\netcenter\controllers\inventory;


use controllers\Controller;
use extensions\netcenter\views\pages\inventory\VendorCreatePage;
use extensions\netcenter\views\pages\inventory\VendorEditPage;
use extensions\netcenter\views\pages\inventory\VendorListPage;
use views\View;

class VendorController extends Controller
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
                return new VendorListPage();
            case 'new':
                return new VendorCreatePage();
            default:
                return new VendorEditPage($param);
        }
    }
}

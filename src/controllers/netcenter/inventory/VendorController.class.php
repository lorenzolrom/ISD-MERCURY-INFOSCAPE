<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 4/25/2019
 * Time: 11:34 AM
 */


namespace controllers\netcenter\inventory;


use controllers\Controller;
use views\pages\netcenter\inventory\VendorCreatePage;
use views\pages\netcenter\inventory\VendorEditPage;
use views\pages\netcenter\inventory\VendorListPage;
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
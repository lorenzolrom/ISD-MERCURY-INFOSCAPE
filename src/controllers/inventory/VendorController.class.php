<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/25/2019
 * Time: 11:34 AM
 */


namespace controllers\inventory;


use controllers\Controller;
use views\pages\inventory\VendorCreatePage;
use views\pages\inventory\VendorEditPage;
use views\pages\inventory\VendorListPage;
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
    public function getPage(): View
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
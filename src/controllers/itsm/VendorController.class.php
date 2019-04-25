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


namespace controllers\itsm;


use controllers\Controller;
use views\pages\itsm\VendorListPage;
use views\View;

class VendorController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): View
    {
        $param = $this->request->next();

        switch($param)
        {
            case null:
                return new VendorListPage();
            default:
                die("view: $param");
        }
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/13/2019
 * Time: 12:15 PM
 */


namespace controllers\itsm;


use controllers\Controller;
use views\pages\itsm\AssetTypeCreatePage;
use views\pages\itsm\AssetTypeEditPage;
use views\pages\itsm\AssetTypeListPage;
use views\View;

class AssetTypeController extends Controller
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
                return new AssetTypeListPage();
            case "new":
                return new AssetTypeCreatePage();
            default:
                return new AssetTypeEditPage($param);
        }
    }
}
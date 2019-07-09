<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/13/2019
 * Time: 12:15 PM
 */


namespace controllers\netcenter\inventory;


use controllers\Controller;
use views\pages\netcenter\inventory\AssetTypeCreatePage;
use views\pages\netcenter\inventory\AssetTypeEditPage;
use views\pages\netcenter\inventory\AssetTypeListPage;
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
    public function getPage(): ?View
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
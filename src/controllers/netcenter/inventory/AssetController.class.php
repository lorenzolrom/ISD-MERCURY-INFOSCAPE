<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 4/15/2019
 * Time: 7:36 PM
 */


namespace controllers\netcenter\inventory;


use controllers\Controller;
use views\pages\netcenter\inventory\AssetEditPage;
use views\pages\netcenter\inventory\AssetSearchPage;
use views\pages\netcenter\inventory\AssetViewPage;
use views\pages\netcenter\inventory\WorksheetPage;
use views\View;

class AssetController extends Controller
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
                return new AssetSearchPage();
            case "worksheet":
                return new WorksheetPage();
            default:
                switch($this->request->next())
                {
                    case 'edit':
                        return new AssetEditPage($param);
                    default:
                        return new AssetViewPage($param);
                }
        }
    }
}
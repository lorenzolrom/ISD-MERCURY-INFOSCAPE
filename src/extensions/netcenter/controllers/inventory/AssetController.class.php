<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/15/2019
 * Time: 7:36 PM
 */


namespace extensions\netcenter\controllers\inventory;


use controllers\Controller;
use extensions\netcenter\views\pages\inventory\AssetEditPage;
use extensions\netcenter\views\pages\inventory\AssetSearchPage;
use extensions\netcenter\views\pages\inventory\AssetViewPage;
use extensions\netcenter\views\pages\inventory\WorksheetPage;
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

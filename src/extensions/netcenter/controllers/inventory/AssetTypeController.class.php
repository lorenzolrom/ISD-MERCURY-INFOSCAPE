<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/13/2019
 * Time: 12:15 PM
 */


namespace extensions\netcenter\controllers\inventory;


use controllers\Controller;
use extensions\netcenter\views\pages\inventory\AssetTypeCreatePage;
use extensions\netcenter\views\pages\inventory\AssetTypeEditPage;
use extensions\netcenter\views\pages\inventory\AssetTypeListPage;
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

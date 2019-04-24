<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/15/2019
 * Time: 7:36 PM
 */


namespace controllers\itsm;


use controllers\Controller;
use views\pages\itsm\AssetSearchPage;
use views\pages\itsm\AssetViewPage;
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
    public function getPage(): View
    {
        $param = $this->request->next();

        switch($param)
        {
            case null:
                return new AssetSearchPage();
            case "worksheet":
                die('worksheet');
            default:
                return new AssetViewPage($param);
        }
    }
}
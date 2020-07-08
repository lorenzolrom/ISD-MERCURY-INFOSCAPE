<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/09/2019
 * Time: 9:31 PM
 */


namespace extensions\facilities\controllers;


use controllers\Controller;
use extensions\facilities\views\pages\BuildingCreatePage;
use extensions\facilities\views\pages\BuildingEditPage;
use extensions\facilities\views\pages\BuildingSearchPage;
use extensions\facilities\views\pages\BuildingViewPage;
use extensions\facilities\views\pages\LocationCreatePage;
use views\View;

class BuildingController extends Controller
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
                return new BuildingSearchPage();
            case "new":
                return new BuildingCreatePage();
            default:
                switch($this->request->next())
                {
                    case "newlocation":
                        return new LocationCreatePage($param);
                    case "edit":
                        return new BuildingEditPage($param);
                }
                return new BuildingViewPage($param);
        }
    }
}

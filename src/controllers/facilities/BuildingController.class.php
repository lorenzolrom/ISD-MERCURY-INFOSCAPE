<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 4/09/2019
 * Time: 9:31 PM
 */


namespace controllers\facilities;


use controllers\Controller;
use views\pages\facilities\BuildingCreatePage;
use views\pages\facilities\BuildingEditPage;
use views\pages\facilities\BuildingSearchPage;
use views\pages\facilities\BuildingViewPage;
use views\pages\facilities\LocationCreatePage;
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
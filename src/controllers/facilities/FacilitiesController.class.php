<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 10:25 AM
 */


namespace controllers\facilities;


use controllers\Controller;
use views\pages\facilities\FacilitiesHome;
use views\View;

class FacilitiesController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        switch($this->request->next())
        {
            case 'buildings':
                $buildings = new BuildingController($this->request);
                return $buildings->getPage();
            case 'locations':
                $locations = new LocationController($this->request);
                return $locations->getPage();
            case NULL:
                return new FacilitiesHome();
        }

        return NULL;
    }
}
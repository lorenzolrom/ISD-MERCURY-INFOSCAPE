<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 10:25 AM
 */


namespace extensions\facilities\controllers;


use controllers\Controller;
use extensions\facilities\views\pages\FacilitiesHome;
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
            case 'floorplans':
                $fp = new FloorplanController($this->request);
                return $fp->getPage();
            case NULL:
                return new FacilitiesHome();
        }

        return NULL;
    }
}

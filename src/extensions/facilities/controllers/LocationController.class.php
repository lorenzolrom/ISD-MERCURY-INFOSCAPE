<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/10/2019
 * Time: 7:17 AM
 */


namespace extensions\facilities\controllers;


use controllers\Controller;
use extensions\facilities\views\pages\LocationEditPage;
use views\View;

class LocationController extends Controller
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
        $param = $this->request->next();

        return new LocationEditPage((int)$param);
    }
}

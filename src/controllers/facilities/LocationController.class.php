<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 4/10/2019
 * Time: 7:17 AM
 */


namespace controllers\facilities;


use controllers\Controller;
use views\pages\facilities\LocationEditPage;
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
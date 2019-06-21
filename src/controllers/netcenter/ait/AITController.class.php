<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 5/03/2019
 * Time: 8:21 PM
 */


namespace controllers\netcenter\ait;


use controllers\Controller;
use views\View;

class AITController extends Controller
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
        $this->request->next();

        $apps = new ApplicationController($this->request);
        return $apps->getPage();
    }
}
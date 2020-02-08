<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/08/2020
 * Time: 2:30 PM
 */


namespace extensions\trs\controllers;


use controllers\Controller;
use extensions\trs\views\pages\BackOfficeHomePage;
use views\View;

class TRSBackOfficeController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        $p1 = $this->request->next(); // First part of URI

        if($p1 === NULL)
            return new BackOfficeHomePage();

        return NULL;
    }
}
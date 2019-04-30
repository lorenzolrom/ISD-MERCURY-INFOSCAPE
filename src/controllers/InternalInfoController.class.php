<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 6:02 PM
 */


namespace controllers;


use views\pages\InternalInfoPage;
use views\View;

class InternalInfoController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): View
    {
        return new InternalInfoPage();
    }
}
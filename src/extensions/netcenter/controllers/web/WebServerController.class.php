<?php
/**
 * LLR Technologies
 * part of LLR Enterprises, www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/6/2020
 * Time: 3:24 PM
 */


namespace extensions\netcenter\controllers\web;


use controllers\Controller;
use extensions\netcenter\views\pages\web\WebServerCreatePage;
use extensions\netcenter\views\pages\web\WebServerEditPage;
use extensions\netcenter\views\pages\web\WebServerSearchPage;
use views\View;

class WebServerController extends Controller
{

    public function getPage(): ?View
    {
        $p1 = $this->request->next();

        if($p1 === NULL)
            return new WebServerSearchPage();
        else if($p1 === 'new')
            return new WebServerCreatePage();
        else
            return new WebServerEditPage($p1);
        return NULL;
    }
}
<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/03/2019
 * Time: 12:46 PM
 */


namespace extensions\netcenter\controllers\web;


use controllers\Controller;
use extensions\netcenter\views\pages\web\VHostLogPage;
use views\View;

class SiteLogsController extends Controller
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
        return new VHostLogPage($this->request->next());
    }
}

<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 8:07 PM
 */


namespace controllers\web;


use controllers\Controller;
use exceptions\PageNotFoundException;
use views\View;

class WebController extends Controller
{

    /**
     * @return View
     * @throws PageNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\EntryNotFoundException
     */
    public function getPage(): View
    {
        switch($this->request->next())
        {
            case 'registrars':
                $registrars = new RegistrarController($this->request);
                return $registrars->getPage();
            case 'vhosts':
                $vhosts = new VHostController($this->request);
                return $vhosts->getPage();
            case 'urlaliases':
                $urlaliases = new URLAliasController($this->request);
                return $urlaliases->getPage();
            case 'sitelogs':
                $sitelogs = new SiteLogsController($this->request);
                return $sitelogs->getPage();
        }

        throw new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND);
    }
}
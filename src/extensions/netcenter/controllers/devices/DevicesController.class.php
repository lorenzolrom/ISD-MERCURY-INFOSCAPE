<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 10:26 AM
 */


namespace extensions\netcenter\controllers\devices;


use controllers\Controller;
use extensions\netcenter\views\pages\devices\DHCPLogPage;
use views\View;

class DevicesController extends Controller
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
            case 'hosts':
                $hosts = new HostController($this->request);
                return $hosts->getPage();
            case 'dhcplogs':
                return new DHCPLogPage();
        }

        return NULL;
    }
}

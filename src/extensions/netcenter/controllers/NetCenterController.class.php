<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/21/2019
 * Time: 9:44 AM
 */


namespace extensions\netcenter\controllers;


use controllers\Controller;
use extensions\netcenter\views\pages\NetCenterHomePage;
use views\View;

class NetCenterController extends Controller
{
    private const CONTROLLERS = array(
        'ait' => 'extensions\netcenter\controllers\ait\AITController',
        'web' => 'extensions\netcenter\controllers\web\WebController',
        'inventory' => 'extensions\netcenter\controllers\inventory\InventoryController',
        'devices' => 'extensions\netcenter\controllers\devices\DevicesController',
        'monitor' => 'extensions\netcenter\controllers\monitor\MonitorController',
    );

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        $route = $this->request->next();


        if($route === NULL)
            return new NetCenterHomePage();
        else if(in_array($route, array_keys(self::CONTROLLERS)))
        {
            $controllerClass = self::CONTROLLERS[$route];
            $controller = new $controllerClass($this->request);
            /** @noinspection PhpUndefinedMethodInspection */
            return $controller->getPage();
        }

        return NULL;
    }
}

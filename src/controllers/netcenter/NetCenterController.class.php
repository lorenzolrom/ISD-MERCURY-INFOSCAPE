<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 6/21/2019
 * Time: 9:44 AM
 */


namespace controllers\netcenter;


use controllers\Controller;
use views\pages\netcenter\NetCenterHomePage;
use views\View;

class NetCenterController extends Controller
{
    private const CONTROLLERS = array(
        'ait' => 'controllers\netcenter\ait\AITController',
        'web' => 'controllers\netcenter\web\WebController',
        'inventory' => 'controllers\netcenter\inventory\InventoryController',
        'devices' => 'controllers\netcenter\devices\DevicesController',
        'monitor' => 'controllers\netcenter\monitor\MonitorController',
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
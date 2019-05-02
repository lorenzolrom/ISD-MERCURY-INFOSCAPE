<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 4:45 PM
 */


namespace factories;

use controllers\Controller;
use exceptions\PageNotFoundException;
use models\HTTPRequest;

class ControllerFactory
{
    private const CONTROLLERS = array(
        'devices' => 'controllers\devices\DevicesController',

        'inventory' => 'controllers\inventory\InventoryController',

        'web' => 'controllers\web\WebController',

        'facilities' => 'controllers\facilities\FacilitiesController',

        'history' => 'controllers\HistoryController',
        'logout' => 'controllers\LogoutController',
        'login' => 'controllers\LoginController',
        'inbox' => 'controllers\InboxController',
        'account' => 'controllers\AccountController',
        'about' => 'controllers\AboutController',
        '!api-request' => 'controllers\APIProxyController',

        'inetinfo' => 'controllers\InternalInfoController'
    );

    /**
     * @param HTTPRequest $request
     * @return Controller
     * @throws PageNotFoundException
     */
    public static function getController(HTTPRequest $request): Controller
    {
        $route = $request->next();

        if($route == null)
            $controller = 'controllers\HomeController';
        else if(!in_array($route, array_keys(self::CONTROLLERS)))
            throw new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND);
        else
            $controller = self::CONTROLLERS[$route];

        return new $controller($request);
    }
}
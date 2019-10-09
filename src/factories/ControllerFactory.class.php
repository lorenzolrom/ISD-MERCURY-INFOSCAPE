<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
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
        'admin' => 'controllers\admin\AdminController',
        'history' => 'controllers\HistoryController',
        'logout' => 'controllers\LogoutController',
        'login' => 'controllers\LoginController',
        'inbox' => 'controllers\InboxController',
        'account' => 'controllers\AccountController',
        'about' => 'controllers\AboutController',
        '!api-request' => 'controllers\APIProxyController'
    );

    /**
     * @param HTTPRequest $request
     * @return Controller
     * @throws PageNotFoundException
     */
    public static function getController(HTTPRequest $request): Controller
    {
        $route = $request->next();

        $controllers = array_merge(self::CONTROLLERS, \Config::OPTIONS['additionalRoutes']);

        if($route == null)
            $controller = 'controllers\PortalController';
        else if(!in_array($route, array_keys($controllers)))
            throw new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND);
        else
            $controller = $controllers[$route];

        return new $controller($request);
    }
}
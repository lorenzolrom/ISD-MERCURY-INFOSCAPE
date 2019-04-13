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


use controllers\AboutController;
use controllers\AccountController;
use controllers\Controller;
use controllers\facilities\BuildingController;
use controllers\facilities\LocationController;
use controllers\HomeController;
use controllers\InboxController;
use controllers\itsm\InventoryController;
use controllers\LoginController;
use controllers\LogoutController;
use controllers\APIProxyController;
use exceptions\PageNotFoundException;
use models\HTTPRequest;

class ControllerFactory
{
    /**
     * @param HTTPRequest $request
     * @return Controller
     * @throws PageNotFoundException
     */
    public static function getController(HTTPRequest $request): Controller
    {
        switch($request->next())
        {
            case "inventory":
                return new InventoryController($request);
            case "buildings":
                return new BuildingController($request);
            case "locations":
                return new LocationController($request);
            case "logout":
                return new LogoutController($request);
            case "login":
                return new LoginController($request);
            case "about":
                return new AboutController($request);
            case "inbox":
                return new InboxController($request);
            case "account":
                return new AccountController($request);
            case "!api-request":
                return new APIProxyController($request);
            case null:
                return new HomeController($request);
            default:
                throw new PageNotFoundException(PageNotFoundException::MESSAGES[PageNotFoundException::PAGE_NOT_FOUND], PageNotFoundException::PAGE_NOT_FOUND);
        }
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 6:12 PM
 */


namespace views\pages\netcenter;


use views\elements\netcenter\NetCenterNavigation;
use views\pages\SidebarDocument;

/**
 * Class MainDocument
 *
 * Template for 'main application' pages
 *
 * @package views\pages
 */
abstract class NetCenterDocument extends SidebarDocument
{
    /**
     * UserDocument constructor.
     * @param string|null $permission
     * @param string|null $section
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL, ?string $section = NULL)
    {
        parent::__construct($permission, 'views\elements\netcenter\NetCenterNavigation', $section);

        $navigation = new NetCenterNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());

        $this->setVariable('appCaption', 'Net Center');
    }
}
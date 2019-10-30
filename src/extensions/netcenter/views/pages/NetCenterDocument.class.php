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


namespace extensions\netcenter\views\pages;


use extensions\netcenter\views\elements\NetCenterNavigation;
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
        parent::__construct($permission, 'extensions\netcenter\views\elements\NetCenterNavigation', $section);

        $navigation = new NetCenterNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());

        $this->setVariable('appCaption', 'Net Center');
    }
}
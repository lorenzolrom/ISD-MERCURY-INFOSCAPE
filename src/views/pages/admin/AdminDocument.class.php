<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:47 PM
 */


namespace views\pages\admin;


use views\elements\admin\AdminNavigation;
use views\pages\SidebarDocument;

abstract class AdminDocument extends SidebarDocument
{
    /**
     * AdminDocument constructor.
     * @param string|null $permission
     * @param string|null $section
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL, ?string $section = NULL)
    {
        parent::__construct($permission);

        $navigation = new AdminNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
    }
}
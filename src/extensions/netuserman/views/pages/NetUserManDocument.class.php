<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 3:37 PM
 */


namespace extensions\netuserman\views\pages;


use extensions\netuserman\views\elements\NetUserManNavigation;
use views\pages\SidebarDocument;

abstract class NetUserManDocument extends SidebarDocument
{
    /**
     * NetUserManDocument constructor.
     * @param string|null $permission
     * @param string|null $section
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL, ?string $section = NULL)
    {
        parent::__construct($permission, 'extensions\netuserman\views\elements\NetUserManNavigation', $section);

        $navigation = new NetUserManNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());

        $this->addStylesheets(array('netuserman/elements.css'));
    }
}
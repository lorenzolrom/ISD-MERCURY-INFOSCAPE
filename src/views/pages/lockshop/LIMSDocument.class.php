<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/24/2019
 * Time: 3:27 PM
 */


namespace views\pages\lockshop;


use views\elements\lockshop\LIMSNavigation;
use views\pages\SidebarDocument;

abstract class LIMSDocument extends SidebarDocument
{
    /**
     * LIMSDocument constructor.
     * @param string|null $permission
     * @param string|null $section
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL, ?string $section = NULL)
    {
        parent::__construct($permission, 'views\elements\lockshop\LIMSNavigation', $section);

        $navigation = new LIMSNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
        $this->setVariable('appCaption', 'Lock Management');
    }
}
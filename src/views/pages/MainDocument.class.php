<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 6:12 PM
 */


namespace views\pages;


use views\elements\Navigation;
use views\elements\Sidebar;

/**
 * Class MainDocument
 *
 * Main Application Template
 *
 * @package views\pages
 */
abstract class MainDocument extends UserDocument
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
        parent::__construct($permission);

        $navigation = new Navigation();
        $this->setVariable('navigation', $navigation->getTemplate());

        if($section !== NULL)
        {
            $sidebar = new Sidebar($section);
            $this->setVariable("sidebar", $sidebar->getTemplate());
        }
    }
}
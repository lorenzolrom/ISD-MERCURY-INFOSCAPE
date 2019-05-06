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


use views\elements\Header;
use views\elements\Navigation;
use views\elements\Sidebar;

abstract class UserDocument extends AuthenticatedPage
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
        $this->setTemplateFromHTML("HTML5Document", self::TEMPLATE_PAGE);

        $this->setVariable("content", self::templateFileContents("UserDocument", self::TEMPLATE_PAGE));

        // Add header
        $header = new Header();
        $this->setVariable("header", $header->getTemplate());

        $navigation = new Navigation();
        $this->setVariable('navigation', $navigation->getTemplate());

        $this->setVariable("footer", self::templateFileContents("Footer", self::TEMPLATE_ELEMENT));

        if($section !== NULL)
        {
            $sidebar = new Sidebar($section);
            $this->setVariable("sidebar", $sidebar->getTemplate());
        }

        $this->setVariable('operatorName', 'Operator: ' . $this->user->getUsername());
    }
}
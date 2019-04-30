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

abstract class UserDocument extends AuthenticatedPage
{
    /**
     * UserDocument constructor.
     * @param string|null $permission
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL)
    {
        parent::__construct($permission);
        $this->setTemplateFromHTML("HTML5Document", self::TEMPLATE_PAGE);

        $this->setVariable("content", self::templateFileContents("UserDocument", self::TEMPLATE_PAGE));

        // Add header
        $header = new Header();
        $this->setVariable("header", $header->getTemplate());

        $navigation = new Navigation($this->user);
        $this->setVariable('navigation', $navigation->getTemplate());

        $this->setVariable("footer", self::templateFileContents("Footer", self::TEMPLATE_ELEMENT));
    }
}
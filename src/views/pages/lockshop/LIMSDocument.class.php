<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/24/2019
 * Time: 3:27 PM
 */


namespace views\pages\lockshop;


use views\elements\Header;
use views\elements\lockshop\LIMSNavigation;
use views\pages\AuthenticatedPage;

abstract class LIMSDocument extends AuthenticatedPage
{
    /**
     * LIMSDocument constructor.
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

        $navigation = new LIMSNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());

        $this->setVariable("footer", self::templateFileContents("Footer", self::TEMPLATE_ELEMENT));

        $this->setVariable('operatorName', 'Operator: ' . $this->user->getUsername());
    }
}
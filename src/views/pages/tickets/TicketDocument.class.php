<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:00 PM
 */


namespace views\pages\tickets;


use views\elements\Header;
use views\elements\tickets\TicketNavigation;
use views\pages\AuthenticatedPage;

abstract class TicketDocument extends AuthenticatedPage
{
    /**
     * TicketDocument constructor.
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

        $navigation = new TicketNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());

        $this->setVariable("footer", self::templateFileContents("Footer", self::TEMPLATE_ELEMENT));

        $this->setVariable('operatorName', 'Operator: ' . $this->user->getUsername());
    }
}
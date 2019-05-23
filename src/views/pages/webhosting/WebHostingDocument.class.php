<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:19 PM
 */


namespace views\pages\webhosting;


use views\elements\Header;
use views\pages\AuthenticatedPage;

abstract class WebHostingDocument extends AuthenticatedPage
{
    /**
     * WebHostingDocument constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplateFromHTML("HTML5Document", self::TEMPLATE_PAGE);

        $this->setVariable("content", self::templateFileContents("PublicDocument", self::TEMPLATE_PAGE));

        // Add header
        $header = new Header();
        $this->setVariable("header", $header->getTemplate());

        $this->setVariable("footer", self::templateFileContents("Footer", self::TEMPLATE_ELEMENT));

        $this->setVariable('operatorName', 'Operator: ' . $this->user->getUsername());
    }
}
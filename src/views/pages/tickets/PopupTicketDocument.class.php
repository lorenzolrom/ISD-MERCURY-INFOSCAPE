<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/16/2019
 * Time: 7:31 AM
 */


namespace views\pages\tickets;


use views\pages\PortalDocument;

abstract class PopupTicketDocument extends PortalDocument
{
    public function __construct()
    {
        parent::__construct('tickets-agent');
        self::setTemplateFromHTML('HTML5Document', self::TEMPLATE_PAGE);
        $this->setVariable('content', self::templateFileContents('tickets/PopupTicketDocument', self::TEMPLATE_PAGE));
        $this->setVariable('header', self::templateFileContents('Header', self::TEMPLATE_ELEMENT));
    }
}
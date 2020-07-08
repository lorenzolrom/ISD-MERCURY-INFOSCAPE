<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 9/16/2019
 * Time: 7:31 AM
 */


namespace extensions\tickets\views\pages;


use views\pages\PortalDocument;

abstract class PopupTicketDocument extends PortalDocument
{
    public function __construct()
    {
        parent::__construct('tickets-agent');
        self::setTemplateFromHTML('HTML5Document', self::TEMPLATE_PAGE);
        $this->loadCustomStyles();
        $this->setVariable('content', self::templateFileContents('PopupTicketDocument', self::TEMPLATE_PAGE, 'tickets'));
        $this->setVariable('header', self::templateFileContents('Header', self::TEMPLATE_ELEMENT));
        $this->addStylesheets(array('tickets/inputs.css', 'tickets/elements.css'));
    }
}

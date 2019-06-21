<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/08/2019
 * Time: 12:10 PM
 */


namespace views\pages;


class InboxPage extends PortalDocument
{
    public function __construct()
    {
        parent::__construct();

        $this->setVariable("tabTitle", "Inbox");
        $this->setVariable("content", self::templateFileContents("Inbox", self::TEMPLATE_PAGE));
    }
}
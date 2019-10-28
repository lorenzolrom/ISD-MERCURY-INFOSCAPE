<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 10/25/2019
 * Time: 9:51 AM
 */


namespace views\pages\game;


use views\pages\PortalDocument;

class ChatClientPage extends PortalDocument
{
    public function __construct()
    {
        parent::__construct('game');
        $this->setVariable("tabTitle", 'Game');
        $this->setVariable("content", self::templateFileContents('game/ChatClient', self::TEMPLATE_PAGE));
    }
}
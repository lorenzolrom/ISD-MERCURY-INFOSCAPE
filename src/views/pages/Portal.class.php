<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 2:47 PM
 */


namespace views\pages;

class Portal extends PortalDocument
{
    public function __construct()
    {
        parent::__construct();
        $this->setVariable("tabTitle", \Config::OPTIONS['appName']);
        $this->setVariable("content", self::templateFileContents("Portal", self::TEMPLATE_CONTENT));
    }
}
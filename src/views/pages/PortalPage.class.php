<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 2:47 PM
 */


namespace views\pages;


class PortalPage extends PublicDocument
{
    public function __construct()
    {
        parent::__construct();
        $this->setVariable("tabTitle", \Config::OPTIONS['appName']);
        $this->setVariable("content", self::templateFileContents("Portal", self::TEMPLATE_PAGE));
    }
}
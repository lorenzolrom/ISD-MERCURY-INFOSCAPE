<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 9:03 PM
 */


namespace views\pages;


class AboutPage extends UserDocument
{
    public function __construct()
    {
        parent::__construct();
        $this->setVariable("tabTitle", "About " . \Config::OPTIONS['appName']);
        $this->setVariable("content", self::templateFileContents("About", self::TEMPLATE_CONTENT));
        $this->setVariable("appVersion", \Version::CURRENT_VERSION);
        $this->setVariable("softwareName", \Version::SOFTWARE_TITLE);
    }
}
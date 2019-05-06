<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 6:11 PM
 */


namespace views\pages;


use views\elements\BulletinList;

class HomePage extends UserDocument
{
    public function __construct()
    {
        parent::__construct();
        $this->setVariable("tabTitle", \Config::OPTIONS['appName'] . " Home");
        $this->setVariable('content', self::templateFileContents('Home', self::TEMPLATE_PAGE));

        $bulletinList = new BulletinList();
        $this->setVariable('bulletinList', $bulletinList->getTemplate());
    }
}
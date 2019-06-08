<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:20 PM
 */


namespace views\pages\webhosting;


use views\pages\UserDocument;

class WebHostingHome extends UserDocument
{
    public function __construct()
    {
        parent::__construct();
        $this->setVariable('tabTitle', 'WebHosting');

        $this->setVariable('content', self::templateFileContents('webhosting/WebHostingHome', self::TEMPLATE_PAGE));
    }
}
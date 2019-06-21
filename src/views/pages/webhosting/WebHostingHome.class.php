<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:20 PM
 */


namespace views\pages\netcenter\webhosting;


use views\pages\SidebarDocument;

class WebHostingHome extends SidebarDocument
{
    public function __construct()
    {
        parent::__construct();
        $this->setVariable('tabTitle', 'WebHosting');

        $this->setVariable('content', self::templateFileContents('webhosting/WebHostingHome', self::TEMPLATE_PAGE));
    }
}
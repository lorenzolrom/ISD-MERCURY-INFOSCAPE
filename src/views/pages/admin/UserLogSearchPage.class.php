<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 3:28 PM
 */


namespace views\pages\admin;


use views\pages\MainDocument;

class UserLogSearchPage extends MainDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'admin');

        $this->setVariable('tabTitle', 'Login History');

        $this->setVariable('content', self::templateFileContents('admin/UserLogSearchPage', self::TEMPLATE_PAGE));
    }
}
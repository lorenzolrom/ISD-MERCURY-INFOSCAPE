<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 11:53 AM
 */


namespace views\pages\admin;


use views\pages\UserDocument;

class UserSearchPage extends UserDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'admin');

        $this->setVariable('tabTitle', 'Users');
        $this->setVariable('content', self::templateFileContents('admin/UserSearchPage', self::TEMPLATE_CONTENT));
    }
}
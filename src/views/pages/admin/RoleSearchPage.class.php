<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 10:21 PM
 */


namespace views\pages\admin;


use views\pages\UserDocument;

class RoleSearchPage extends UserDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'admin');
        $this->setVariable('tabTitle', 'Roles');
        $this->setVariable('content', self::templateFileContents('admin/RoleSearchPage', self::TEMPLATE_PAGE));
    }
}
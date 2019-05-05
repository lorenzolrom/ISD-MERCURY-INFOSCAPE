<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 4:02 PM
 */


namespace views\pages\admin;


use views\pages\UserDocument;

class PermissionAuditSearchPage extends UserDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'admin');

        $this->setVariable('tabTitle', 'Audit Permissions');

        $this->setVariable('content', self::templateFileContents('admin/PermissionAuditSearchPage', self::TEMPLATE_CONTENT));
    }
}
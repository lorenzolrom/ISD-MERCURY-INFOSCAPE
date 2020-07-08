<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 4:02 PM
 */


namespace views\pages\admin;


class PermissionAuditSearchPage extends AdminDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'users');

        $this->setVariable('tabTitle', 'Audit Permissions');

        $this->setVariable('content', self::templateFileContents('admin/PermissionAuditSearchPage', self::TEMPLATE_PAGE));
    }
}

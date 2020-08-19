<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 10:21 PM
 */


namespace views\pages\admin;


class RoleSearchPage extends AdminDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'roles');
        $this->setVariable('tabTitle', 'Roles');
        $this->setVariable('content', self::templateFileContents('admin/RoleSearchPage', self::TEMPLATE_PAGE));
    }
}

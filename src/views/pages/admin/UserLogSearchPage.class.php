<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 3:28 PM
 */


namespace views\pages\admin;


class UserLogSearchPage extends AdminDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'users');

        $this->setVariable('tabTitle', 'Login History');

        $this->setVariable('content', self::templateFileContents('admin/UserLogSearchPage', self::TEMPLATE_PAGE));
    }
}

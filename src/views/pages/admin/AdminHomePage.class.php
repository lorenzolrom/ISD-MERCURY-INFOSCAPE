<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:48 PM
 */


namespace views\pages\admin;


class AdminHomePage extends AdminDocument
{
    public function __construct()
    {
        parent::__construct('settings');
        $this->setVariable('tabTitle', '{{@appName}} Configuration');

        $this->setVariable('content', self::templateFileContents('admin/AdminHome', self::TEMPLATE_PAGE));
    }
}

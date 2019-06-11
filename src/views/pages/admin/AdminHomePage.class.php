<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
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
        parent::__construct('tickets');
        $this->setVariable('tabTitle', '{{@appName}} Configuration');

        $this->setVariable('content', self::templateFileContents('admin/AdminHome', self::TEMPLATE_PAGE));
    }
}
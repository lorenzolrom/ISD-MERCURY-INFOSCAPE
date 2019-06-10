<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 4:32 PM
 */


namespace views\pages\admin;


use views\pages\MainDocument;

class BulletinSearchPage extends MainDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'admin');
        $this->setVariable('tabTitle', 'Bulletins');
        $this->setVariable('content', self::templateFileContents("admin/BulletinSearchPage", self::TEMPLATE_PAGE));
    }
}
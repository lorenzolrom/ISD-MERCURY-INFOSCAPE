<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/02/2019
 * Time: 1:10 AM
 */


namespace extensions\netuserman\views\pages;


class SearchUserPage extends NetUserManDocument
{
    public function __construct()
    {
        parent::__construct('netuserman-read', 'netUsers');
        $this->setVariable('tabTitle', 'Search Users');
        $this->setVariable('content', self::templateFileContents('SearchUserPage', self::TEMPLATE_PAGE, 'netuserman'));
    }
}

<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/02/2019
 * Time: 1:10 AM
 */


namespace extensions\netuserman\views\pages;


class SearchGroupPage extends NetUserManDocument
{
    public function __construct()
    {
        parent::__construct('netuserman-readgroups', 'netGroups');
        $this->setVariable('tabTitle', 'Search Groups');
        $this->setVariable('content', self::templateFileContents('SearchGroupPage', self::TEMPLATE_PAGE, 'netuserman'));
    }
}

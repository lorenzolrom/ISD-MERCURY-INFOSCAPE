<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 10:56 PM
 */


namespace views\pages;

class HistorySearchPage extends PortalDocument
{
    public function __construct()
    {
        parent::__construct();

        $this->setVariable('content', self::templateFileContents('HistorySearch', self::TEMPLATE_PAGE));
        $this->setVariable('tabTitle', "Search History");
    }
}

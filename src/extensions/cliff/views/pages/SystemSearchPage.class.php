<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/11/2020
 * Time: 12:45 PM
 */


namespace extensions\cliff\views\pages;


class SystemSearchPage extends CliffDocument
{
    public function __construct()
    {
        parent::__construct('cliff-r', 'records');

        $this->setVariable('tabTitle', 'Systems');

        $this->setVariable('content', self::templateFileContents('SystemSearchPage', self::TEMPLATE_PAGE, 'cliff'));
    }
}

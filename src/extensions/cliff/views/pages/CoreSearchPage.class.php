<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/11/2020
 * Time: 6:22 PM
 */


namespace extensions\cliff\views\pages;


class CoreSearchPage extends CliffDocument
{
    public function __construct()
    {
        parent::__construct('cliff-r', 'records');

        $this->setVariable('tabTitle', 'Cores');

        $this->setVariable('content', self::templateFileContents('CoreSearchPage', self::TEMPLATE_PAGE, 'cliff'));
    }
}

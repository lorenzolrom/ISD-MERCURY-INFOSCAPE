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
 * Time: 6:22 PM
 */


namespace extensions\cliff\views\pages;


class XRefPeoplePage extends CliffDocument
{
    public function __construct()
    {
        parent::__construct('cliff-r', 'xref');

        $this->setVariable('tabTitle', 'X-Reference People');

        $this->setVariable('content', self::templateFileContents('XRefPeoplePage', self::TEMPLATE_PAGE, 'cliff'));
    }
}

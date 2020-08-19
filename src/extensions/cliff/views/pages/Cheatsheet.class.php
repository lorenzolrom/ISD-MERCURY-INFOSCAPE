<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/02/2020
 * Time: 9:52 AM
 */


namespace extensions\cliff\views\pages;


class Cheatsheet extends CliffDocument
{
    public function __construct()
    {
        parent::__construct('cliff-r', 'records');

        $this->setVariable('tabTitle', 'A2 Cheatsheet');

        $this->setVariable('content', self::templateFileContents('Cheatsheet', self::TEMPLATE_PAGE, 'cliff'));
    }
}

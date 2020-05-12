<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 5/11/2020
 * Time: 12:45 PM
 */


namespace extensions\cliff\views\pages;


class CompareCoresPage extends CliffDocument
{
    public function __construct()
    {
        parent::__construct('cliff-r', 'processing');

        $this->setVariable('tabTitle', 'Compare Cores');

        $this->setVariable('content', self::templateFileContents('CompareCoresPage', self::TEMPLATE_PAGE, 'cliff'));
    }
}
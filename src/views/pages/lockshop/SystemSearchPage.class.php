<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/13/2019
 * Time: 12:05 PM
 */


namespace views\pages\lockshop;


class SystemSearchPage extends LIMSDocument
{
    public function __construct()
    {
        parent::__construct('lockshop-r','systems');

        $this->setVariable('content',self::templateFileContents('lockshop/SystemSearchPage', self::TEMPLATE_PAGE));
        $this->setVariable('tabTitle', 'Systems');
    }
}
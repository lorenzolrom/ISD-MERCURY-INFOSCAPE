<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 6:11 PM
 */


namespace extensions\netcenter\views\pages;


class NetCenterHomePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm');
        $this->setVariable("tabTitle", "Net Center");
        $this->setVariable('content', self::templateFileContents('Home', self::TEMPLATE_PAGE, 'netcenter'));
    }
}
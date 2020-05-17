<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 3:39 PM
 */


namespace extensions\netuserman\views\pages;


class NetUserManHomePage extends NetUserManDocument
{
    public function __construct()
    {
        parent::__construct('netuserman');
        $this->setVariable("tabTitle", "AD Users & Groups");
        $this->setVariable('content', self::templateFileContents('Home', self::TEMPLATE_PAGE, 'netuserman'));
    }
}
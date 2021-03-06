<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
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

<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 9:48 PM
 */


namespace extensions\netcenter\views\pages\web;


use extensions\netcenter\views\pages\NetCenterDocument;

class URLAliasSearchPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_web-aliases-rw', 'web');

        $this->setVariable('tabTitle', 'URL Aliases');
        $this->setVariable('content', self::templateFileContents('web/URLAliasSearchPage', self::TEMPLATE_PAGE, 'netcenter'));
    }
}

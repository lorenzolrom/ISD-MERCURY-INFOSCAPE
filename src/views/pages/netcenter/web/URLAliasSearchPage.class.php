<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 9:48 PM
 */


namespace views\pages\netcenter\web;


use views\pages\netcenter\NetCenterDocument;

class URLAliasSearchPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_web-aliases-rw', 'web');

        $this->setVariable('tabTitle', 'URL Aliases');
        $this->setVariable('content', self::templateFileContents('web/URLAliasSearchPage', self::TEMPLATE_PAGE));
    }
}
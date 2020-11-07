<?php
/**
 * LLR Technologies
 * part of LLR Enterprises, www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/6/2020
 * Time: 3:22 PM
 */


namespace extensions\netcenter\views\pages\web;


use extensions\netcenter\views\pages\NetCenterDocument;

class WebServerSearchPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_web-servers-r', 'web');

        $this->setVariable('tabTitle', 'Web Servers');
        $this->setVariable('content', self::templateFileContents('web/WebServerSearchPage', self::TEMPLATE_PAGE, 'netcenter'));
    }
}
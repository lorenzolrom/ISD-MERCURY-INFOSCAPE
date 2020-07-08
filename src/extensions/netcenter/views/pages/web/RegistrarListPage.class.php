<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 8:05 PM
 */


namespace extensions\netcenter\views\pages\web;


use extensions\netcenter\views\pages\NetCenterDocument;

class RegistrarListPage extends NetCenterDocument
{
    /**
     * RegistrarListPage constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct('itsm_web-registrars-r', 'web');

        $this->setVariable('tabTitle', 'Registrars');
        $this->setVariable('content', self::templateFileContents('web/RegistrarListPage', self::TEMPLATE_PAGE, 'netcenter'));
    }
}

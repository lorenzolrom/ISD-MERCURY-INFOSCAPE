<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 8:05 PM
 */


namespace views\pages\web;


use views\pages\UserDocument;

class RegistrarListPage extends UserDocument
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
        $this->setVariable('content', self::templateFileContents('web/RegistrarListPage', self::TEMPLATE_CONTENT));
    }
}
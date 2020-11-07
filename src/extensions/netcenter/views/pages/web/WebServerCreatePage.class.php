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
 * Time: 4:38 PM
 */


namespace extensions\netcenter\views\pages\web;


use extensions\netcenter\views\forms\web\WebServerForm;
use extensions\netcenter\views\pages\NetCenterDocument;

class WebServerCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_web-servers-w', 'web');
        $this->setVariable('tabTitle', 'Web Server (New)');

        $form = new WebServerForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
    }
}
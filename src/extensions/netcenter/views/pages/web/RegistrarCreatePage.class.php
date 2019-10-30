<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 8:22 PM
 */


namespace extensions\netcenter\views\pages\web;

use extensions\netcenter\views\forms\web\RegistrarForm;
use extensions\netcenter\views\pages\NetCenterDocument;

class RegistrarCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_web-registrars-w', 'web');

        $this->setVariable('tabTitle', 'Registrar (New)');

        $form = new RegistrarForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return createRegistrar()');
    }
}
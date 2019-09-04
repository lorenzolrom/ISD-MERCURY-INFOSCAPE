<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 8:48 PM
 */


namespace views\pages\netcenter\web;


use views\forms\netcenter\web\RegistrarForm;
use views\pages\netcenter\ModelPage;

class RegistrarEditPage extends ModelPage
{
    public function __construct(?string $registrarId)
    {
        parent::__construct("registrars/$registrarId", 'itsm_web-registrars-r', 'web');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Registrar - ' . $details['name'] . ' (Edit)');

        $form = new RegistrarForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return saveChanges('{{@id}}')");
        $this->setVariable('id', $registrarId);

        $this->setVariables($details);
    }
}
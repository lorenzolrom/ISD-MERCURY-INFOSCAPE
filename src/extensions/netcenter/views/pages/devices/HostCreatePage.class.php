<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 9:29 PM
 */


namespace extensions\netcenter\views\pages\devices;


use extensions\netcenter\views\forms\devices\HostForm;
use extensions\netcenter\views\pages\NetCenterDocument;

class HostCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_devices-hosts-w', 'devices');

        $this->setVariable('tabTitle', 'Host (New)');

        $form = new HostForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return createHost()");
    }
}
<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 9:21 PM
 */


namespace extensions\netcenter\views\pages\devices;


use extensions\netcenter\views\forms\devices\HostForm;
use extensions\netcenter\views\pages\ModelPage;

class HostEditPage extends ModelPage
{
    public function __construct(?string $hostId)
    {
        parent::__construct("hosts/$hostId", 'itsm_devices-hosts-r', 'devices');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Host - ' . $details['ipAddress'] . ' (Edit)');

        $form = new HostForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return saveChanges('{{@id}}')");
        $this->setVariable('id', $hostId);
    }
}

<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 9:21 PM
 */


namespace views\pages\itsm;


use views\forms\itsm\HostForm;
use views\pages\ModelPage;

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
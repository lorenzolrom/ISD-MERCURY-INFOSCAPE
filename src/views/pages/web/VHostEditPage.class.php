<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 4:45 PM
 */


namespace views\pages\web;


use views\forms\web\VHostForm;
use views\pages\ModelPage;

class VHostEditPage extends ModelPage
{
    public function __construct(?string $vhostId)
    {
        parent::__construct("vhosts/$vhostId", 'itsm_web-vhosts-r', 'web');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', "VHost - {$details['subdomain']}.{$details['domain']} (Edit)");

        $form = new VHostForm($details);
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return saveChanges('{{@id}}')");
        $this->setVariable('id', $vhostId);

        $this->setVariables($details);
    }
}
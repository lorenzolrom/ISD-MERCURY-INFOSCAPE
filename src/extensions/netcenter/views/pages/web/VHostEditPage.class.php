<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 4:45 PM
 */


namespace extensions\netcenter\views\pages\web;


use extensions\netcenter\views\forms\web\VHostForm;
use extensions\netcenter\views\pages\ModelPage;

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
        $this->setVariable('serverLink', '<a href="../servers/{{@host}}"><i class="icon">desktop_windows</i></a>');
        $this->setVariable('historyLink', '<a class="history-link" href="{{@baseURI}}history/vhost/{{@id}}"><i class="icon" title="View History">history</i></a>');
        $this->setVariable('editMenu', '<a class="button delete-button confirm-button" href="javascript: deleteVHost(\'{{@id}}\')"><i class="icon">delete</i>Delete</a> <a class="button" id="viewLogButton" href="{{@baseURI}}netcenter/web/sitelogs/{{@id}}"><i class="icon">description</i>View Logs</a>');
        $this->setVariable('regLink', '<a href="{{@baseURI}}netcenter/web/registrars/{{@registrar}}"><i class="icon">work</i></a>');
        $this->setVariable('id', $vhostId);

        $this->setVariables($details);
    }
}

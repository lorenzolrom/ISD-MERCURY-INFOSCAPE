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
 * Time: 10:00 PM
 */


namespace extensions\netcenter\views\pages\web;


use extensions\netcenter\views\forms\web\WebServerForm;
use extensions\netcenter\views\pages\ModelPage;

class WebServerEditPage extends ModelPage
{
    public function __construct(?string $host)
    {
        parent::__construct("webservers/$host", 'itsm_web-servers-r', 'web');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', "Web Server - {$details['systemName']} (Edit)");

        $form = new WebServerForm($details);
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return save('{{@host}}')");

        $this->setVariable('systemNameDisabled', 'disabled');
        $this->setVariable('editMenu', '<a class="button delete-button confirm-button" href="javascript: remove(\'{{@host}}\')"><i class="icon">delete</i>Delete</a>');
        $this->setVariable('historyLink', '<a class="history-link" href="{{@baseURI}}history/webserver/{{@host}}"><i class="icon" title="View History">history</i></a>');
        $this->setVariable('hostLink', '<a href="../../devices/hosts/{{@host}}"><i class="icon">desktop_windows</i></a>');
        $this->setVariables($details);
    }
}
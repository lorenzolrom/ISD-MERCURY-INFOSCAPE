<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 9:53 PM
 */


namespace views\pages\netcenter\web;


use views\forms\netcenter\web\URLAliasForm;
use views\pages\netcenter\NetCenterDocument;

class URLAliasCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_web-aliases-rw', 'web');

        $this->setVariable('tabTitle', 'URL Alias (New)');

        $form = new URLAliasForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return createEntry()');
    }
}
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
 * Time: 9:53 PM
 */


namespace extensions\netcenter\views\pages\web;


use extensions\netcenter\views\forms\web\URLAliasForm;
use extensions\netcenter\views\pages\NetCenterDocument;

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

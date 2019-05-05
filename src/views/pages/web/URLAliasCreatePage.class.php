<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 9:53 PM
 */


namespace views\pages\web;


use views\forms\web\URLAliasForm;
use views\pages\UserDocument;

class URLAliasCreatePage extends UserDocument
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
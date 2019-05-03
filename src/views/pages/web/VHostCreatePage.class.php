<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 6:25 PM
 */


namespace views\pages\web;


use views\forms\web\VHostForm;
use views\pages\UserDocument;

class VHostCreatePage extends UserDocument
{
    public function __construct()
    {
        parent::__construct('itsm_web-vhosts-w', 'web');

        $this->setVariable('tabTitle', 'VHost (New)');

        $form = new VHostForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return createVHost()');
    }
}
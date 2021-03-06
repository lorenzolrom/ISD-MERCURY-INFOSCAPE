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
 * Time: 6:25 PM
 */


namespace extensions\netcenter\views\pages\web;


use extensions\netcenter\views\forms\web\VHostForm;
use extensions\netcenter\views\pages\NetCenterDocument;

class VHostCreatePage extends NetCenterDocument
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

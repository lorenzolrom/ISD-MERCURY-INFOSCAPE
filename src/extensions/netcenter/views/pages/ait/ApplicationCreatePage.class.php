<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 2:05 PM
 */


namespace extensions\netcenter\views\pages\ait;


use extensions\netcenter\views\forms\ait\ApplicationForm;
use extensions\netcenter\views\pages\NetCenterDocument;

class ApplicationCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_ait-apps-w', 'ait');

        $form = new ApplicationForm();

        $this->setVariable('tabTitle', "Application (New)");
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('cancelLink', "{{@baseURI}}netcenter/ait/applications");
        $this->setVariable('formScript', "return create()");
    }
}

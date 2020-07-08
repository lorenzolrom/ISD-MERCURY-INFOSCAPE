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
 * Time: 11:15 AM
 */


namespace extensions\netcenter\views\pages\ait;


use extensions\netcenter\views\forms\ait\ApplicationForm;
use extensions\netcenter\views\pages\ModelPage;

class ApplicationEditPage extends ModelPage
{
    public function __construct(?string $param)
    {
        parent::__construct("applications/$param", 'itsm_ait-apps-w', 'ait');

        $details = $this->response->getBody();

        $form = new ApplicationForm($details);

        $this->setVariable('tabTitle', "Application - " . htmlentities($details['name']) . " (Edit)");
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('cancelLink', "{{@baseURI}}netcenter/ait/applications/{$details['number']}");
        $this->setVariable('formScript', "return save('{$details['number']}')");
    }
}

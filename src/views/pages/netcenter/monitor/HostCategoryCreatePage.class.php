<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 10:07 AM
 */


namespace views\pages\netcenter\monitor;


use views\forms\netcenter\monitor\HostCategoryForm;
use views\pages\netcenter\NetCenterDocument;

class HostCategoryCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsmmonitor-hosts-w', 'monitor');

        $form = new HostCategoryForm();

        $this->setVariable('tabTitle', 'Host Category (New)');
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
    }
}
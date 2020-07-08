<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 10:07 AM
 */


namespace extensions\netcenter\views\pages\monitor;


use extensions\netcenter\views\forms\monitor\HostCategoryForm;
use extensions\netcenter\views\pages\NetCenterDocument;

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

<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/11/2020
 * Time: 1:12 PM
 */


namespace extensions\cliff\views\pages;


use extensions\cliff\views\forms\SystemForm;

class SystemCreatePage extends CliffDocument
{
    public function __construct()
    {
        parent::__construct('cliff-w', 'records');

        $this->setVariable('tabTitle', 'System (New)');

        $form = new SystemForm();
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'create()');
    }
}

<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/13/2019
 * Time: 1:38 PM
 */


namespace views\pages\lockshop;


use views\forms\lockshop\SystemForm;

class SystemCreatePage extends LIMSDocument
{
    public function __construct()
    {
        parent::__construct('lockshop-w', 'systems');

        $form = new SystemForm();

        $this->setVariable('tabTitle', 'System (New)');
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
        $this->setVariable('cancelLink', '{{@baseURI}}lockshop/systems');
    }
}
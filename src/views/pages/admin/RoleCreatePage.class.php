<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 10:53 PM
 */


namespace views\pages\admin;


use views\forms\admin\RoleForm;
use views\pages\MainDocument;

class RoleCreatePage extends MainDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'admin');

        $this->setVariable('tabTitle', 'Role (Create)');

        $form = new RoleForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
    }
}
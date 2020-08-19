<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 10:53 PM
 */


namespace views\pages\admin;


use views\forms\admin\RoleForm;

class RoleCreatePage extends AdminDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'roles');

        $this->setVariable('tabTitle', 'Role (Create)');

        $form = new RoleForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
    }
}

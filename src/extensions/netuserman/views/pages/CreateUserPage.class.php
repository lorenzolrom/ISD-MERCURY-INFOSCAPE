<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/02/2019
 * Time: 9:29 PM
 */


namespace extensions\netuserman\views\pages;


use extensions\netuserman\views\forms\CreateUserForm;

class CreateUserPage extends NetUserManDocument
{
    public function __construct()
    {
        parent::__construct('netuserman-create', 'netUsers');

        $form = new CreateUserForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('tabTitle', 'Create User');
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 12:17 PM
 */


namespace views\pages\admin;


use views\forms\admin\UserForm;
use views\pages\MainDocument;

class MainCreatePage extends MainDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'admin');

        $form = new UserForm();

        $this->setVariable('tabTitle', 'User (New)');
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
        $this->setVariable('passwordRequired', "class='required'");
    }
}
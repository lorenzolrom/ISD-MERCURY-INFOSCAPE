<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 6:32 PM
 */


namespace views\pages\admin;


use views\forms\admin\BulletinForm;
use views\pages\UserDocument;

class BulletinCreatePage extends UserDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'admin');

        $this->setVariable('tabTitle', 'Bulletin (New)');

        $form = new BulletinForm();
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
    }
}
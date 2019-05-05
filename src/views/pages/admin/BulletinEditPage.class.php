<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 6:21 PM
 */


namespace views\pages\admin;


use views\forms\admin\BulletinForm;
use views\pages\ModelPage;

class BulletinEditPage extends ModelPage
{
    public function __construct(?string $param)
    {
        parent::__construct("bulletins/$param", 'settings', 'admin');

        $details = $this->response->getBody();

        $form = new BulletinForm($details);

        $this->setVariable('tabTitle', "Bulletin - {$details['title']} (Edit)");
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return save('$param')");
    }
}
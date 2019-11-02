<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 8:40 PM
 */


namespace extensions\netuserman\views\pages;


use extensions\netuserman\views\forms\EditUserForm;

class EditUserPage extends ModelPage
{
    public function __construct(string $username)
    {
        parent::__construct('netuserman/' . $username, 'netuserman-edit-details', 'netUsers');

        $details = $this->response->getBody();

        $form = new EditUserForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('tabTitle', 'Edit User: ' . $details['userprincipalname']);
        $this->setVariable('thumbnailphotoPath', \Config::OPTIONS['baseURI'] . 'netuserman/photo/' . $username);
    }
}
<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/02/2019
 * Time: 11:23 PM
 */


namespace extensions\netuserman\views\pages;


use extensions\netuserman\views\forms\CreateGroupForm;

class CreateGroupPage extends NetUserManDocument
{
    public function __construct()
    {
        parent::__construct('netuserman-creategroups', 'netGroups');

        $form = new CreateGroupForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('tabTitle', 'Create Group');
    }
}

<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 8:40 PM
 */


namespace extensions\netuserman\views\pages;


use extensions\netuserman\views\forms\EditGroupForm;

class EditGroupPage extends ModelPage
{
    public function __construct(string $guid)
    {
        parent::__construct('netgroupman/' . $guid, 'netuserman-editgroups', 'netGroups');

        $details = $this->response->getBody();

        $form = new EditGroupForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('tabTitle', 'Edit Group: ' . $details['cn']);
    }
}

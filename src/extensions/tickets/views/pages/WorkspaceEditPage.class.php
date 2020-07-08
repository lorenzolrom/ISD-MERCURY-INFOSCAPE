<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 8:15 AM
 */


namespace extensions\tickets\views\pages;

use extensions\tickets\views\forms\WorkspaceForm;

class WorkspaceEditPage extends ModelPage
{
    /**
     * WorkspaceEditPage constructor.
     * @param string|null $id
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $id)
    {
        parent::__construct("tickets/workspaces/$id", 'tickets-admin', 'admin');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Workspace - ' . $details['name'] . ' (Edit)');
        $form = new WorkspaceForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return save('{{@id}}')");
        $this->setVariable('id', $id);
    }
}

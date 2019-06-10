<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 8:15 AM
 */


namespace views\pages\tickets;

use views\forms\tickets\WorkspaceForm;

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
        parent::__construct("tickets/workspaces/$id", 'tickets-admin');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Workspace - ' . $details['name'] . ' (Edit)');
        $form = new WorkspaceForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return save('{{@id}}')");
        $this->setVariable('id', $id);
    }
}
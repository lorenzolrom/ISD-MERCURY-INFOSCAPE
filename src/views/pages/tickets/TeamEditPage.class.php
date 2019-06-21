<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 9:00 AM
 */


namespace views\pages\tickets;


use views\forms\tickets\TeamForm;

class TeamEditPage extends ModelPage
{
    public function __construct(?string $id)
    {
        parent::__construct("tickets/teams/$id", 'tickets-admin', 'admin');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Team - ' . $details['name'] . ' (Edit)');
        $form = new TeamForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return save('{{@id}}')");
        $this->setVariable('id', $id);
    }
}
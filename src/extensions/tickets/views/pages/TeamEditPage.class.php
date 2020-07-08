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
 * Time: 9:00 AM
 */


namespace extensions\tickets\views\pages;


use extensions\tickets\views\forms\TeamForm;

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

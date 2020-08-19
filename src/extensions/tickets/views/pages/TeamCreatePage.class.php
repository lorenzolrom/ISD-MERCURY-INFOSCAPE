<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 8:51 AM
 */


namespace extensions\tickets\views\pages;


use extensions\tickets\views\forms\TeamForm;

class TeamCreatePage extends TicketDocument
{
    public function __construct()
    {
        parent::__construct('tickets-admin', 'admin');
        $this->setVariable('tabTitle', 'Team (New)');

        $form = new TeamForm();
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
    }
}

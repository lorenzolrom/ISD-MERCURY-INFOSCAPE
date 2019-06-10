<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 8:05 AM
 */


namespace views\forms\tickets;


use utilities\InfoCentralConnection;
use views\forms\Form;

class WorkspaceForm extends Form
{
    /**
     * WorkspaceForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML("tickets/WorkspaceForm", self::TEMPLATE_FORM);

        $teams = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'tickets/teams')->getBody();

        if($details !== NULL)
        {
            $this->setVariables($details);
        }

        $teamSelect = '';

        foreach($teams as $team)
        {
            $selected = '';

            if($details !== NULL)
            {
                foreach($details['teams'] as $assignedTeam)
                {
                    if($team['id'] == $assignedTeam['id'])
                        $selected = 'selected';
                }
            }

            $teamSelect .= "<option value='{$team['id']}' $selected>{$team['name']}</option>";
        }

        $this->setVariable('teamSelect', $teamSelect);
    }
}
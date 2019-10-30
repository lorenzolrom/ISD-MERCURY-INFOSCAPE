<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/12/2019
 * Time: 1:00 PM
 */


namespace extensions\tickets\views\pages;


use utilities\InfoCentralConnection;

class TicketSearchPage extends ModelPage
{
    public function __construct(string $id, bool $loadSearch = FALSE)
    {
        parent::__construct('tickets/workspaces/' . $id, 'tickets-agent', 'agent');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Advanced Search');
        $this->setVariable('content', self::templateFileContents('TicketSearchForm', self::TEMPLATE_FORM, 'tickets'));
        $this->setVariable('workspace', $details['name']);

        $attributeTypes = array('status', 'closureCode', 'category', 'type', 'severity');

        foreach($attributeTypes as $attributeType)
        {
            $attributes = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'tickets/workspaces/' . $id . '/attributes/' . $attributeType)->getBody();

            $select = '';

            foreach($attributes as $attribute)
            {
                $selected = '';

                if(isset($details[$attributeType]) AND ($details[$attributeType] == $attribute['code']))
                    $selected = ' selected';

                $select .= "<option value='{$attribute['code']}' {$selected}>{$attribute['name']}</option>";
            }

            $this->setVariable($attributeType . 'Select', $select);
        }

        // Assignees
        $select = '';
        $teams = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'tickets/workspaces/' . $id . '/assignees')->getBody();

        foreach($teams as $team)
        {
            $selected = '';

            if(isset($details['assignees']) AND in_array($team['id'], $details['assignees']))
                $selected = 'selected';

            $select .= "<option class='team' value='{$team['id']}' $selected>{$team['name']}</option>";

            foreach($team['users'] as $user)
            {
                $selected = '';

                if(isset($details['assignees']) AND in_array($team['id'] . '-' . $user['id'], $details['assignees']))
                    $selected = 'selected';

                $select .= "<option class='user' value='{$team['id']}-{$user['id']}' $selected>{$user['name']} ({$user['username']})</option>";
            }
        }

        $this->setVariable('assignees', $select);

        if($loadSearch)
        {
            $this->setVariable('loadSearch', 'loadSearch()');
        }
    }
}
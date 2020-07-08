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
 * Time: 8:35 AM
 */


namespace extensions\tickets\views\forms;


use utilities\InfoCentralConnection;
use views\forms\Form;

class TeamForm extends Form
{
    /**
     * TeamForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML("TeamForm", self::TEMPLATE_FORM, 'tickets');

        $users = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'users')->getBody();

        if($details !== NULL)
        {
            $this->setVariables($details);
        }

        $userSelect = '';

        foreach($users as $user)
        {
            $selected = '';

            if($details !== NULL)
            {
                foreach($details['users'] as $member)
                {
                    if($user['id'] == $member['id'])
                        $selected = 'selected';
                }
            }

            $userSelect .= "<option value='{$user['id']}' $selected>{$user['firstName']} {$user['lastName']} ({$user['username']})</option>";
        }

        $this->setVariable('userSelect', $userSelect);
    }
}

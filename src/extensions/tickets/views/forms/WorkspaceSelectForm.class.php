<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/06/2019
 * Time: 8:06 AM
 */


namespace extensions\tickets\views\forms;


use utilities\InfoCentralConnection;
use views\forms\Form;

class WorkspaceSelectForm extends Form
{
    /**
     * WorkspaceSelectForm constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('WorkspaceSelectForm', self::TEMPLATE_FORM, 'tickets');

        $workspaces = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'tickets/workspaces')->getBody();

        $workspaceSelect = '';

        foreach($workspaces as $workspace)
        {
            $workspaceSelect .= "<option value='{$workspace['id']}'>{$workspace['name']}</option>";
        }

        $this->setVariable('workspaceSelect', $workspaceSelect);
    }
}

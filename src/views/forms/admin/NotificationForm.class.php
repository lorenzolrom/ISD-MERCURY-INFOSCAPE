<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 5:34 PM
 */


namespace views\forms\admin;


use utilities\InfoCentralConnection;
use views\forms\Form;

class NotificationForm extends Form
{
    /**
     * NotificationForm constructor.
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('admin/NotificationForm', self::TEMPLATE_FORM);

        $roles = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'roles')->getBody();

        $roleSelect = "";

        foreach($roles as $role)
        {
            $roleSelect .= "<option value='{$role['id']}'>{$role['name']}</option>";
        }

        $this->setVariable('roleSelect', $roleSelect);
    }
}

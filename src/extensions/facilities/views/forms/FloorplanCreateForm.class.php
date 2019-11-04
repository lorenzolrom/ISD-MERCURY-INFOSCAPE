<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/03/2019
 * Time: 12:01 PM
 */


namespace extensions\facilities\views\forms;


use views\forms\Form;

class FloorplanCreateForm extends Form
{
    /**
     * CreateFloorplanForm constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML("CreateFloorplanForm", self::TEMPLATE_FORM, 'facilities');
    }
}
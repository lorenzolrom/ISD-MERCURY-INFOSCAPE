<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/14/2019
 * Time: 12:00 PM
 */


namespace extensions\netcenter\views\forms\inventory;


use views\forms\Form;

class WarehouseForm extends Form
{
    /**
     * WarehouseForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML("inventory/WarehouseForm", self::TEMPLATE_FORM, 'netcenter');

        if($details !== NULL)
        {
            $this->setVariable("code", $details['code']);
            $this->setVariable("name", htmlentities($details['name']));
        }
    }
}
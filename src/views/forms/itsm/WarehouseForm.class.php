<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/14/2019
 * Time: 12:00 PM
 */


namespace views\forms\itsm;


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
        $this->setTemplateFromHTML("itsm/WarehouseForm", self::TEMPLATE_FORM);

        if($details !== NULL)
        {
            $this->setVariable("code", $details['code']);
            $this->setVariable("name", $details['name']);
        }
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/10/2019
 * Time: 6:28 PM
 */


namespace views\forms\netcenter\inventory;


use views\forms\Form;

class PurchaseOrderForm extends Form
{
    /**
     * PurchaseOrderForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('inventory/PurchaseOrderForm', self::TEMPLATE_FORM);

        if($details !== NULL)
            $this->setVariables($details);
    }
}
<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/10/2019
 * Time: 6:28 PM
 */


namespace extensions\netcenter\views\forms\inventory;


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
        $this->setTemplateFromHTML('inventory/PurchaseOrderForm', self::TEMPLATE_FORM, 'netcenter');

        if($details !== NULL)
            $this->setVariables($details);
    }
}

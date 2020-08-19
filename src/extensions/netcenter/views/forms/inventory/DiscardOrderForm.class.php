<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 1:13 PM
 */


namespace extensions\netcenter\views\forms\inventory;


use views\forms\Form;

class DiscardOrderForm extends Form
{
    /**
     * DiscardOrderForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('inventory/DiscardOrderForm', self::TEMPLATE_FORM, 'netcenter');

        if($details !== NULL)
            $this->setVariables($details);
    }
}

<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/26/2019
 * Time: 8:45 AM
 */


namespace extensions\netcenter\views\forms\inventory;


use views\forms\Form;

class AssetForm extends Form
{
    /**
     * AssetForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML("inventory/AssetForm", self::TEMPLATE_FORM, 'netcenter');

        if($details !== NULL)
            $this->setVariables($details);
    }
}

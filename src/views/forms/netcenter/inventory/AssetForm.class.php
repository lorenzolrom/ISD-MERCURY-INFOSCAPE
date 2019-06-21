<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/26/2019
 * Time: 8:45 AM
 */


namespace views\forms\inventory;


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
        $this->setTemplateFromHTML("inventory/AssetForm", self::TEMPLATE_FORM);

        if($details !== NULL)
            $this->setVariables($details);
    }
}
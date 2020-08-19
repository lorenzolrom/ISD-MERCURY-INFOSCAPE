<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/04/2019
 * Time: 6:54 AM
 */


namespace extensions\facilities\views\forms;


use views\forms\Form;

class FloorplanEditForm extends Form
{
    /**
     * FloorplanEditForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML("EditFloorplanForm", self::TEMPLATE_FORM, 'facilities');

        if($details !== NULL)
            $this->setVariables($details);
    }
}

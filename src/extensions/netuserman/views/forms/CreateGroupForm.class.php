<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/02/2019
 * Time: 11:22 PM
 */


namespace extensions\netuserman\views\forms;


use views\forms\Form;

class CreateGroupForm extends Form
{
    /**
     * CreateGroupForm constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('CreateGroupForm', self::TEMPLATE_FORM, 'netuserman');
    }
}

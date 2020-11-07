<?php
/**
 * LLR Technologies
 * part of LLR Enterprises, www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/6/2020
 * Time: 4:36 PM
 */


namespace extensions\netcenter\views\forms\web;


use views\forms\Form;

class WebServerForm extends Form
{
    /**
     * WebServerForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('web/WebServerForm', self::TEMPLATE_FORM, 'netcenter');

        if($details !== NULL)
            $this->setVariables($details);
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 6/03/2019
 * Time: 8:05 AM
 */


namespace views\forms\tickets;


use views\forms\Form;

class WorkspaceForm extends Form
{
    /**
     * WorkspaceForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML("tickets/WorkspaceForm", self::TEMPLATE_FORM);

        if($details !== NULL)
        {
            $this->setVariables($details);
        }
    }
}
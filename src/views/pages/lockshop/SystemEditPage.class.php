<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 6/13/2019
 * Time: 2:52 PM
 */


namespace views\pages\lockshop;


use views\forms\lockshop\SystemForm;

class SystemEditPage extends ModelPage
{
    /**
     * SystemEditPage constructor.
     * @param int $id
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(int $id)
    {
        parent::__construct("lockshop/systems/$id", 'lockshop-w', 'systems');

        $details = $this->response->getBody();

        $form = new SystemForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('tabTitle', 'System - ' . $details['name'] . ' (Edit)');
        $this->setVariable('formScript', "return update('$id')");
        $this->setVariable('cancelLink', '{{@baseURI}}lockshop/systems/' . $id);
    }
}
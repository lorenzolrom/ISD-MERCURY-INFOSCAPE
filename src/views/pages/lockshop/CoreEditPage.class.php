<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/17/2019
 * Time: 12:53 PM
 */


namespace views\pages\lockshop;


use views\forms\lockshop\CoreForm;

class CoreEditPage extends ModelPage
{
    /**
     * CoreEditPage constructor.
     * @param string|null $id
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $id)
    {
        parent::__construct("lockshop/cores/$id", 'lockshop-r', 'locks');

        $details = $this->response->getBody();

        $form = new CoreForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('cancelLink', "{{@baseURI}}lockshop/systems/{$details['system']}");
        $this->setVariable('formScript', "return save('$id')");
        $this->setVariable('tabTitle', "Core - {$details['code']} (Edit)");
    }
}
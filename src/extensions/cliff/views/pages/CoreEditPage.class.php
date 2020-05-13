<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 5/11/2020
 * Time: 1:32 PM
 */


namespace extensions\cliff\views\pages;


use extensions\cliff\views\forms\CoreForm;

class CoreEditPage extends ModelPage
{
    public function __construct(?string $id)
    {
        parent::__construct("lockcores/$id", 'cliff-r', 'records');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Core - ' . $details['systemCode'] . '/' . $details['stamp'] . ' (Edit)');

        $form = new CoreForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "update('{{@id}}')");
        $this->setVariable('editToolbar', self::templateFileContents('CoreFormEditToolbar', self::TEMPLATE_ELEMENT, 'cliff'));
        $this->setVariable('coreLocations', self::templateFileContents('CoreLocations', self::TEMPLATE_ELEMENT, 'cliff'));
        $this->setVariable('historyLink', self::templateFileContents('CoreHistoryLink', self::TEMPLATE_ELEMENT, 'cliff'));
        $this->setVariable('id', $id);
    }
}
<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/11/2020
 * Time: 1:32 PM
 */


namespace extensions\cliff\views\pages;


use extensions\cliff\views\forms\KeyForm;

class KeyEditPage extends ModelPage
{
    public function __construct(?string $id)
    {
        parent::__construct("lockkeys/$id", 'cliff-r', 'records');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Key - ' . $details['systemCode'] . '/' . $details['stamp'] . ' (Edit)');

        $form = new KeyForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "update('{{@id}}')");
        $this->setVariable('editToolbar', self::templateFileContents('KeyFormEditToolbar', self::TEMPLATE_ELEMENT, 'cliff'));
        $this->setVariable('keyIssues', self::templateFileContents('KeyIssues', self::TEMPLATE_ELEMENT, 'cliff'));
        $this->setVariable('historyLink', self::templateFileContents('KeyHistoryLink', self::TEMPLATE_ELEMENT, 'cliff'));
        $this->setVariable('id', $id);
    }
}

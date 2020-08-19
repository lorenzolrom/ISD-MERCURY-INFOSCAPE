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


use extensions\cliff\views\forms\SystemForm;

class SystemEditPage extends ModelPage
{
    public function __construct(?string $id)
    {
        parent::__construct("locksystems/$id", 'cliff-r', 'records');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'System - ' . $details['code'] . ' (Edit)');

        $form = new SystemForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "update('{{@id}}')");
        $this->setVariable('editToolbar', self::templateFileContents('SystemFormEditToolbar', self::TEMPLATE_ELEMENT, 'cliff'));
        $this->setVariable('historyLink', self::templateFileContents('SystemHistoryLink', self::TEMPLATE_ELEMENT, 'cliff'));
        $this->setVariable('id', $id);
    }
}

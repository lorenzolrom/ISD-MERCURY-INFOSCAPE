<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/02/2019
 * Time: 9:56 PM
 */


namespace views\pages\web;


use views\forms\web\URLAliasForm;
use views\pages\ModelPage;

class URLAliasEditPage extends ModelPage
{
    public function __construct(?string $id)
    {
        parent::__construct("urlaliases/$id", 'itsm_web-aliases-rw', 'web');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', "URL Alias - {$details['alias']} (Edit)");

        $form = new URLAliasForm($details);
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return saveChanges('{{@id}}')");
        $this->setVariable('id', $id);
    }
}
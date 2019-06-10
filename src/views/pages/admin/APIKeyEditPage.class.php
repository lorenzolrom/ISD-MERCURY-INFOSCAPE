<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 12:26 AM
 */


namespace views\pages\admin;


use views\forms\admin\APIKeyForm;
use views\pages\ModelPage;

class APIKeyEditPage extends ModelPage
{
    public function __construct(?string $param)
    {
        parent::__construct("secrets/$param", 'api-settings', 'admin');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', "API Key - " . htmlentities($details['name']) . " (Edit)");

        $form = new APIKeyForm($details);

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return save('$param')");
    }
}
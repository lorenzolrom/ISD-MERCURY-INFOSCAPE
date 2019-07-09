<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 10:10 AM
 */


namespace views\pages\netcenter\monitor;

use views\forms\netcenter\monitor\HostCategoryForm;
use views\pages\netcenter\ModelPage;

class HostCategoryEditPage extends ModelPage
{
    public function __construct(?string $param)
    {
        parent::__construct("hostCategories/$param", 'itsmmonitor-hosts-w', 'monitor');

        $details = $this->response->getBody();

        $form = new HostCategoryForm($details);

        $this->setVariable('tabTitle', "Host Category - " . htmlentities($details['name']) . " (Edit)");
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return save('$param')");
    }
}
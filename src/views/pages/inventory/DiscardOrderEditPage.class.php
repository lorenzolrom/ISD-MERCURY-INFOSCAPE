<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 1:18 PM
 */


namespace views\pages\inventory;


use views\forms\inventory\DiscardOrderForm;
use views\pages\ModelPage;

class DiscardOrderEditPage extends ModelPage
{
    public function __construct(string $param)
    {
        parent::__construct("discardorders/$param", 'itsm_inventory-discards-w', 'inventory');

        $details = $this->response->getBody();

        $form = new DiscardOrderForm($details);

        $this->setVariable('tabTitle', "Discard Order - $param (Edit)");
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return save('$param')");
        $this->setVariable('cancelLink', \Config::OPTIONS['baseURI'] . "inventory/discards/$param");
    }
}
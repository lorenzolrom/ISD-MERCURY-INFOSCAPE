<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 1:18 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\forms\inventory\DiscardOrderForm;
use extensions\netcenter\views\pages\ModelPage;

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
        $this->setVariable('cancelLink', \Config::OPTIONS['baseURI'] . "netcenter/inventory/discards/$param");
    }
}

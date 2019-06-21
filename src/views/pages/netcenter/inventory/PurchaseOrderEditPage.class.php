<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 5/11/2019
 * Time: 11:48 AM
 */


namespace views\pages\netcenter\inventory;


use views\forms\netcenter\inventory\PurchaseOrderForm;
use views\pages\netcenter\ModelPage;

class PurchaseOrderEditPage extends ModelPage
{
    public function __construct(string $param)
    {
        parent::__construct("purchaseorders/$param", 'itsm_inventory-purchaseorders-w', 'inventory');

        $details = $this->response->getBody();

        $form = new PurchaseOrderForm($details);

        $this->setVariable('tabTitle', "Purchase Order - $param (Edit)");
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return save('$param')");
        $this->setVariable('cancelLink', \Config::OPTIONS['baseURI'] . "inventory/purchaseorders/$param");
    }
}
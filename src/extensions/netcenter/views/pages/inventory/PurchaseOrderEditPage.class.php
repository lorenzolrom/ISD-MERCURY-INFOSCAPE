<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/11/2019
 * Time: 11:48 AM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\forms\inventory\PurchaseOrderForm;
use extensions\netcenter\views\pages\ModelPage;

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
        $this->setVariable('cancelLink', '{{@baseURI}}netcenter/inventory/purchaseorders/' . $param);
    }
}

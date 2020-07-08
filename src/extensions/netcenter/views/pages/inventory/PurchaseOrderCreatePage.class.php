<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/10/2019
 * Time: 6:30 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\forms\inventory\PurchaseOrderForm;
use extensions\netcenter\views\pages\NetCenterDocument;

class PurchaseOrderCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-purchaseorders-w', 'inventory');

        $form = new PurchaseOrderForm();

        $this->setVariable('tabTitle', 'Purchase Order (New)');
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
        $this->setVariable('cancelLink', '{{@baseURI}}netcenter/inventory/purchaseorders');
    }
}

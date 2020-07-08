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
use extensions\netcenter\views\pages\NetCenterDocument;

class DiscardOrderCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-discards-w', 'inventory');

        $form = new DiscardOrderForm();

        $this->setVariable('tabTitle', 'Discard Order (New)');
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
        $this->setVariable('cancelLink', '{{@baseURI}}netcenter/inventory/discards');
    }
}

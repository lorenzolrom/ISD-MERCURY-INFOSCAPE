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
use views\pages\UserDocument;

class DiscardOrderCreatePage extends UserDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-discards-w', 'inventory');

        $form = new DiscardOrderForm();

        $this->setVariable('tabTitle', 'Discard Order (New)');
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
        $this->setVariable('cancelLink', '{{@baseURI}}inventory/discards');
    }
}
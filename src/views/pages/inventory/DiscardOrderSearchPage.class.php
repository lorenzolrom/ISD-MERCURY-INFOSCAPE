<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 12:49 PM
 */


namespace views\pages\inventory;


use views\pages\UserDocument;

class DiscardOrderSearchPage extends UserDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-discards-r', 'inventory');

        $this->setVariable('tabTitle', 'Discards');
        $this->setVariable('content', self::templateFileContents('inventory/DiscardOrderSearchPage', self::TEMPLATE_PAGE));
    }
}
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
 * Time: 12:49 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\pages\NetCenterDocument;

class DiscardOrderSearchPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-discards-r', 'inventory');

        $this->setVariable('tabTitle', 'Discards');
        $this->setVariable('content', self::templateFileContents('inventory/DiscardOrderSearchPage', self::TEMPLATE_PAGE, 'netcenter'));
    }
}

<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 1:19 PM
 */


namespace views\pages\netcenter\inventory;


use views\pages\netcenter\ModelPage;

class DiscardOrderViewPage extends ModelPage
{
    public function __construct(string $param)
    {
        parent::__construct("discardorders/$param", 'itsm_inventory-discards-r', 'inventory');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', "Discard Order - $param");
        $this->setVariable('content', self::templateFileContents('inventory/DiscardOrderViewPage', self::TEMPLATE_PAGE));

        $this->setVariable('approved', $details['approved'] ? 'Yes' : 'No');
        $this->setVariable('fulfilled', $details['fulfilled'] ? 'Yes' : 'No');
        $this->setVariable('canceled', $details['canceled'] ? 'Yes' : 'No');

        $this->setVariables($details);
    }
}
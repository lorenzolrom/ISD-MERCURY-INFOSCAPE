<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/26/2019
 * Time: 8:48 AM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\forms\inventory\AssetForm;
use extensions\netcenter\views\pages\ModelPage;

class AssetEditPage extends ModelPage
{
    public function __construct(?string $assetTag)
    {
        parent::__construct("assets/$assetTag", 'itsm_inventory-assets-w', 'inventory');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Asset - ' . $details['assetTag'] . ' (Edit)');

        $form = new AssetForm($details);

        $this->setVariable("content", $form->getTemplate());
    }
}

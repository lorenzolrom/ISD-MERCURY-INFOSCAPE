<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/16/2019
 * Time: 5:35 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\pages\ModelPage;

class AssetViewPage extends ModelPage
{
    public function __construct(?string $assetTag)
    {
        parent::__construct("assets/$assetTag", 'itsm_inventory-assets-r', 'inventory');

        $asset = $this->response->getBody();

        $this->setVariable("content", self::templateFileContents("inventory/Asset", self::TEMPLATE_PAGE, 'netcenter'));

        $this->setVariable("tabTitle", "Asset - " . $assetTag);

        $this->setVariable('verified', $asset['verified'] == '1' ? 'Yes' : 'No');
        $this->setVariable('discarded', $asset['discarded'] == '1' ? 'Yes' : 'No');

        $this->setVariables($asset);
    }
}

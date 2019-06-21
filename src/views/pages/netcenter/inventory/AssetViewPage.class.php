<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/16/2019
 * Time: 5:35 PM
 */


namespace views\pages\netcenter\inventory;


use views\pages\netcenter\ModelPage;

class AssetViewPage extends ModelPage
{
    public function __construct(?string $assetTag)
    {
        parent::__construct("assets/$assetTag", 'itsm_inventory-assets-r', 'inventory');

        $asset = $this->response->getBody();

        $this->setVariable("content", self::templateFileContents("inventory/Asset", self::TEMPLATE_PAGE));

        $this->setVariable("tabTitle", "Asset - " . $assetTag);

        $this->setVariable('verified', $asset['verified'] == '1' ? 'Yes' : 'No');
        $this->setVariable('discarded', $asset['discarded'] == '1' ? 'Yes' : 'No');

        $this->setVariables($asset);
    }
}
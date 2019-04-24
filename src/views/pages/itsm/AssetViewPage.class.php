<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/16/2019
 * Time: 5:35 PM
 */


namespace views\pages\itsm;


use views\pages\ModelPage;

class AssetViewPage extends ModelPage
{
    public function __construct(?string $assetTag)
    {
        parent::__construct("assets/$assetTag", 'itsm_inventory-assets-r', 'inventory');

        $asset = $this->response->getBody();

        $this->setVariable("content", self::templateFileContents("itsm/Asset", self::TEMPLATE_CONTENT));

        $this->setVariable("tabTitle", "Asset - " . $assetTag);

        $this->setVariable('verified', $asset['verified'] == '1' ? 'Yes' : 'No');
        $this->setVariable('discarded', $asset['discarded'] == '1' ? 'Yes' : 'No');

        $this->setVariables($asset);
    }
}
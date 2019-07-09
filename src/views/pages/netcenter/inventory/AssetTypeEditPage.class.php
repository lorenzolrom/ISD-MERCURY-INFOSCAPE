<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/13/2019
 * Time: 12:54 PM
 */


namespace views\pages\netcenter\inventory;


use views\forms\netcenter\inventory\AssetTypeForm;
use views\pages\netcenter\ModelPage;

class AssetTypeEditPage extends ModelPage
{
    public function __construct(?string $assetTypeId)
    {
        parent::__construct("commodities/assetTypes/$assetTypeId", "itsm_inventory-commodities-w", 'inventory');

        $details = $this->response->getBody();

        $this->setVariable("tabTitle", "Asset Type - " . $details['name'] . " (Edit)");

        $form = new AssetTypeForm($details);

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}netcenter/inventory/assetTypes");
        $this->setVariable("formScript", "return saveChanges('{{@id}}')");
        $this->setVariable('id', $assetTypeId);
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/13/2019
 * Time: 4:07 PM
 */


namespace views\pages\netcenter\inventory;


use views\forms\netcenter\inventory\AssetTypeForm;
use views\pages\netcenter\NetCenterDocument;

class AssetTypeCreatePage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-commodities-w', 'inventory');

        $this->setVariable("tabTitle", "Asset Type (New)");

        $form = new AssetTypeForm();

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}netcenter/inventory/assettypes");
        $this->setVariable("formScript", "return createAssetType()");
    }
}
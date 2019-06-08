<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/13/2019
 * Time: 4:07 PM
 */


namespace views\pages\inventory;


use views\forms\inventory\AssetTypeForm;
use views\pages\MainDocument;

class AssetTypeCreatePage extends MainDocument
{
    public function __construct()
    {
        parent::__construct('itsm_inventory-commodities-w', 'inventory');

        $this->setVariable("tabTitle", "Asset Type (New)");

        $form = new AssetTypeForm();

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}inventory/assettypes");
        $this->setVariable("formScript", "return createAssetType()");
    }
}
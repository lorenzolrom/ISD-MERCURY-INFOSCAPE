<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/13/2019
 * Time: 12:54 PM
 */


namespace extensions\netcenter\views\pages\inventory;


use extensions\netcenter\views\forms\inventory\AssetTypeForm;
use extensions\netcenter\views\pages\ModelPage;

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

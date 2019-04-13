<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/12/2019
 * Time: 5:21 PM
 */


namespace views\pages\itsm;


use views\pages\ModelPage;

class CommodityViewPage extends ModelPage
{
    /**
     * CommodityViewPage constructor.
     * @param string|null $commodityId
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $commodityId)
    {
        parent::__construct("commodities/$commodityId", 'itsm_inventory-commodities-r', 'inventory');

        $commodity = $this->response->getBody();

        $this->setVariable("content", self::templateFileContents("itsm/Commodity", self::TEMPLATE_CONTENT));

        $this->setVariable("tabTitle", "Commodity - " . htmlentities($commodity['name']));

        $this->setVariable('id', $commodity['id']);
        $this->setVariable('code', htmlentities($commodity['code']));
        $this->setVariable('name', htmlentities($commodity['name']));
        $this->setVariable('commodityTypeName', htmlentities($commodity['commodityTypeName']));
        $this->setVariable('assetTypeName', htmlentities($commodity['assetTypeName']));
        $this->setVariable('manufacturer', htmlentities($commodity['manufacturer']));
        $this->setVariable('model', htmlentities($commodity['model']));
        $this->setVariable('unitCost', $commodity['unitCost']);
        $this->setVariable('createDate', htmlentities($commodity['createDate']));
        $this->setVariable('createUser', htmlentities($commodity['createUser']));
        $this->setVariable('lastModifyDate', htmlentities($commodity['lastModifyDate']));
        $this->setVariable('lastModifyUser', htmlentities($commodity['lastModifyUser']));
    }
}
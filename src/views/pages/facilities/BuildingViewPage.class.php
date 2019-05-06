<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/09/2019
 * Time: 10:42 PM
 */


namespace views\pages\facilities;

use views\pages\ModelPage;

class BuildingViewPage extends ModelPage
{
    public function __construct(?string $buildingId)
    {
        parent::__construct("buildings/$buildingId", "facilitiescore_facilities-r", 'buildings');

        $building = $this->response->getBody();

        $this->setVariable("content", self::templateFileContents("facilities/Building", self::TEMPLATE_PAGE));

        $this->setVariable("tabTitle", "Building - " . htmlentities($building['name']));

        $this->setVariable('id', $building['id']);
        $this->setVariable('code', htmlentities($building['code']));
        $this->setVariable('name', htmlentities($building['name']));
        $this->setVariable('streetAddress', htmlentities($building['streetAddress']));
        $this->setVariable('city', htmlentities($building['city']));
        $this->setVariable('state', htmlentities($building['state']));
        $this->setVariable('zipCode', htmlentities($building['zipCode']));
    }
}
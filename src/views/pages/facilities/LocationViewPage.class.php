<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/10/2019
 * Time: 7:26 AM
 */


namespace views\pages\facilities;


use views\pages\ModelPage;

class LocationViewPage extends ModelPage
{
    public function __construct(int $locationId)
    {
        parent::__construct("locations/$locationId", "facilitiescore_facilities-r", 'buildings');

        $location = $this->response->getBody();
        $this->setVariable("content", self::templateFileContents("facilities/Location", self::TEMPLATE_CONTENT));

        $this->setVariable("tabTitle", htmlentities("Location - " . $location['buildingName'] . "/" . $location['name']));

        $this->setVariable("buildingId", $location['buildingId']);
        $this->setVariable("buildingCode", $location['buildingCode']);
        $this->setVariable("buildingName", $location['buildingName']);
        $this->setVariable("id", $location['id']);
        $this->setVariable("code", $location['code']);
        $this->setVariable("name", $location['name']);
        $this->setVariable("createDate", $location['createDate']);
        $this->setVariable("createUser", $location['createUser']);
        $this->setVariable("lastModifyUser", $location['lastModifyUser']);
        $this->setVariable("lastModifyDate", $location['lastModifyDate']);
    }
}
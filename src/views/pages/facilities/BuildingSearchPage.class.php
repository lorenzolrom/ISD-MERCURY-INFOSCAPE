<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/09/2019
 * Time: 9:35 PM
 */


namespace views\pages\facilities;


use views\pages\NetCenterDocument;

class BuildingSearchPage extends NetCenterDocument
{
    public function __construct()
    {
        parent::__construct("facilitiescore_facilities-r", 'buildings');

        $this->setVariable("tabTitle", "Buildings");
        $this->setVariable("content", self::templateFileContents("facilities/BuildingSearchPage", self::TEMPLATE_PAGE));
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/09/2019
 * Time: 9:35 PM
 */


namespace extensions\facilities\views\pages;


class BuildingSearchPage extends FacilitiesDocument
{
    public function __construct()
    {
        parent::__construct("facilitiescore_facilities-r", 'buildings');

        $this->setVariable("tabTitle", "Buildings");
        $this->setVariable("content", self::templateFileContents("BuildingSearchPage", self::TEMPLATE_PAGE, 'facilities'));
    }
}
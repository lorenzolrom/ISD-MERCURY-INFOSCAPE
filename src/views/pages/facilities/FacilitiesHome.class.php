<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:13 PM
 */


namespace views\pages\facilities;


class FacilitiesHome extends FacilitiesDocument
{
    public function __construct()
    {
        parent::__construct('facilitiescore_facilities-r');
        $this->setVariable('tabTitle', 'Facilities Management');

        $this->setVariable('content', self::templateFileContents('facilities/FacilitiesHome', self::TEMPLATE_PAGE));
    }
}
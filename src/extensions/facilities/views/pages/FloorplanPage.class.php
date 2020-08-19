<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/03/2019
 * Time: 8:00 PM
 */


namespace extensions\facilities\views\pages;


class FloorplanPage extends ModelPage
{
    public function __construct(int $id)
    {
        parent::__construct("floorplans/$id", "facilitiescore_floorplans-r", 'floorplans');

        $details = $this->response->getBody();

        $this->setVariable('content', self::templateFileContents('FloorplanPage', self::TEMPLATE_PAGE,'facilities'));

        $this->setVariable('tabTitle', 'Building ' . $details['buildingCode'] . ' Floor ' . $details['floor']);

        $this->setVariables($details);

        $this->setVariable('src', \Config::OPTIONS['baseURI'] . 'facilities/floorplans/image/' . $id);
        $this->setVariable('id', $id);
    }
}

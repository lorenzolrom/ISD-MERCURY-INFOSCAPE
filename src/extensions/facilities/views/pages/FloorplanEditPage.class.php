<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/04/2019
 * Time: 7:06 AM
 */


namespace extensions\facilities\views\pages;


use extensions\facilities\views\forms\FloorplanEditForm;

class FloorplanEditPage extends ModelPage
{
    public function __construct(int $id)
    {
        parent::__construct('floorplans/' . $id, 'facilitiescore_floorplans-w', 'floorplans');
        $details = $this->response->getBody();

        $this->setVariable("tabTitle", "Building " . $details['buildingCode'] . " Floor " . $details['floor'] . " (Edit)");

        $form = new FloorplanEditForm($details);

        $this->setVariable("content", $form->getTemplate());
        $this->setVariables($details);
    }
}

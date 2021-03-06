<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/10/2019
 * Time: 7:10 PM
 */


namespace extensions\facilities\views\pages;


use extensions\facilities\views\forms\BuildingForm;

class BuildingCreatePage extends FacilitiesDocument
{
    /**
     * BuildingCreatePage constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct('facilitiescore_facilities-w', 'buildings');

        $this->setVariable("tabTitle", "Building (New)");

        $form = new BuildingForm();

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}facilities/buildings");
        $this->setVariable("formScript", "return createBuilding()");
    }
}

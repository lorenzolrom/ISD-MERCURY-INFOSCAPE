<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/10/2019
 * Time: 7:10 PM
 */


namespace views\pages\facilities;


use views\forms\facilities\BuildingForm;
use views\pages\MainDocument;

class BuildingCreatePage extends MainDocument
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
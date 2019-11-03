<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/03/2019
 * Time: 12:02 PM
 */


namespace extensions\facilities\views\pages;


use extensions\facilities\views\forms\CreateFloorplanForm;

class CreateFloorplanPage extends FacilitiesDocument
{
    public function __construct(?array $details = NULL)
    {
        parent::__construct('facilitiescore_floorplans-w', 'floorplans');

        $form = new CreateFloorplanForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('tabTitle', 'Create Floorplan');

        if($details !== NULL)
            $this->setVariables($details);
    }
}
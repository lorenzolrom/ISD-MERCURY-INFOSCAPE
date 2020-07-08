<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/03/2019
 * Time: 12:02 PM
 */


namespace extensions\facilities\views\pages;


use extensions\facilities\views\forms\FloorplanCreateForm;

class FloorplanCreatePage extends FacilitiesDocument
{
    public function __construct(?array $details = NULL)
    {
        parent::__construct('facilitiescore_floorplans-w', 'floorplans');

        $form = new FloorplanCreateForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('tabTitle', 'New Floorplan');

        if($details !== NULL)
            $this->setVariables($details);
    }
}

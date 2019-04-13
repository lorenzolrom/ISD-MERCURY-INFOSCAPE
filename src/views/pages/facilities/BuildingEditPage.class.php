<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/10/2019
 * Time: 9:33 AM
 */


namespace views\pages\facilities;


use views\forms\facilities\BuildingForm;
use views\pages\ModelPage;

class BuildingEditPage extends ModelPage
{
    /**
     * BuildingEditPage constructor.
     * @param string|null $buildingId
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $buildingId)
    {
        parent::__construct("buildings/$buildingId", 'facilitiescore_facilities-w', 'buildings');

        $details = $this->response->getBody();

        $this->setVariable("tabTitle", "Building - " . $details['name'] . " (Edit)");

        $form = new BuildingForm($details);

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("cancelLink", "{{@baseURI}}buildings/{{@id}}");
        $this->setVariable("formScript", "return saveChanges('{{@id}}')");

        $this->setVariable("id", $buildingId);
    }
}
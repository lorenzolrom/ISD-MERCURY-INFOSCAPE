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
 * Time: 8:55 PM
 */


namespace extensions\facilities\views\pages;


use exceptions\EntryNotFoundException;
use utilities\InfoCentralConnection;
use extensions\facilities\views\forms\LocationForm;

class LocationCreatePage extends FacilitiesDocument
{
    /**
     * LocationCreatePage constructor.
     * @param string|null $buildingId
     * @throws EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $buildingId)
    {
        parent::__construct('facilitiescore_facilities-w', 'buildings');

        $this->setVariable("tabTitle", "Location (New)");

        // Load building details
        $response = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "buildings/$buildingId");

        if($response->getResponseCode() != '200')
            throw new EntryNotFoundException(EntryNotFoundException::MESSAGES[EntryNotFoundException::PRIMARY_KEY_NOT_FOUND], EntryNotFoundException::PRIMARY_KEY_NOT_FOUND);

        $details = $response->getBody();

        $form = new LocationForm(array(
            'buildingCode' => $details['code'],
            'buildingName' => $details['name'],
            'buildingId' => $details['id']
        ));

        $this->setVariable("content", $form->getTemplate());
        $this->setVariable("formScript", "return createLocation('{{@buildingId}}')");
        $this->setVariable("buildingId", $details['id']);
    }
}

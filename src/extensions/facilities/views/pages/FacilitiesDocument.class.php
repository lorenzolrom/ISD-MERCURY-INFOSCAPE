<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:09 PM
 */


namespace extensions\facilities\views\pages;


use extensions\facilities\views\elements\FacilitiesNavigation;
use views\pages\SidebarDocument;

abstract class FacilitiesDocument extends SidebarDocument
{
    /**
     * FacilitiesDocument constructor.
     * @param string|null $permission
     * @param string|null $sectionTitle
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL, ?string $sectionTitle = NULL)
    {
        parent::__construct($permission, 'extensions\facilities\views\elements\FacilitiesNavigation', $sectionTitle);

        $navigation = new FacilitiesNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
        $this->setVariable('appCaption', 'Facilities');

        $this->addStylesheets(array('facilities/elements.css', 'facilities/inputs.css'));
    }
}

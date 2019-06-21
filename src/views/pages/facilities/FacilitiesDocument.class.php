<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:09 PM
 */


namespace views\pages\facilities;


use views\elements\facilities\FacilitiesNavigation;
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
        parent::__construct($permission, 'views\elements\facilities\FacilitiesNavigation', $sectionTitle);

        $navigation = new FacilitiesNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
    }
}
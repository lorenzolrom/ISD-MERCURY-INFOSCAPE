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
    public function __construct(?string $permission = NULL)
    {
        parent::__construct($permission);

        $navigation = new FacilitiesNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
    }
}
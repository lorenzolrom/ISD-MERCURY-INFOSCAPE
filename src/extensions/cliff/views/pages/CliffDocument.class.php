<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 4/02/2020
 * Time: 9:51 AM
 */


namespace extensions\cliff\views\pages;


use extensions\cliff\views\elements\CliffNavigation;
use views\pages\SidebarDocument;

abstract class CliffDocument extends SidebarDocument
{
    public function __construct(?string $permission = NULL, ?string $sectionTitle = NULL)
    {
        parent::__construct($permission, 'extensions\cliff\views\elements\CliffNavigation', $sectionTitle);

        $navigation = new CliffNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
        $this->setVariable('appCaption', 'CLIFF');

        $this->addStylesheets(array('cliff/elements.css'));
    }
}
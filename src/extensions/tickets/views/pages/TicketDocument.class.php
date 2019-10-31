<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:00 PM
 */


namespace extensions\tickets\views\pages;


use extensions\tickets\views\elements\TicketNavigation;
use views\pages\SidebarDocument;

abstract class TicketDocument extends SidebarDocument
{
    /**
     * TicketDocument constructor.
     * @param string|null $permission
     * @param string|null $section
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL, ?string $section = NULL)
    {
        parent::__construct($permission, 'extensions\tickets\views\elements\TicketNavigation', $section);

        $navigation = new TicketNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
        $this->setVariable('appCaption', 'Service Center');
        $this->addStylesheets(array('tickets/inputs.css', 'tickets/elements.css'));
    }
}
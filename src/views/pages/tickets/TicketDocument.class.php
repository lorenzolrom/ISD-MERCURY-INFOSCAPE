<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:00 PM
 */


namespace views\pages\tickets;


use views\elements\tickets\TicketNavigation;
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
        parent::__construct($permission, 'views\elements\tickets\TicketNavigation', $section);

        $navigation = new TicketNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
        $this->setVariable('appCaption', 'Service Center');
    }
}
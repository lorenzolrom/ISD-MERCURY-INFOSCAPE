<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:00 PM
 */


namespace views\pages\tickets;


use views\elements\tickets\TicketNavigation;
use views\pages\UserDocument;

abstract class TicketDocument extends UserDocument
{
    /**
     * TicketDocument constructor.
     * @param string|null $permission
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL)
    {
        parent::__construct($permission);

        $navigation = new TicketNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
    }
}
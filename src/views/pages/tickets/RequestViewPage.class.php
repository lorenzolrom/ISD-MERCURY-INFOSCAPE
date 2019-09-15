<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 12:09 PM
 */


namespace views\pages\tickets;


class RequestViewPage extends ModelPage
{
    public function __construct(int $workspace, int $number)
    {
        parent::__construct("tickets/requests/$workspace/$number", 'tickets-customer', 'requests');

        $details = $this->response->getBody();

        $this->setVariable('content', self::templateFileContents('tickets/RequestViewPage', self::TEMPLATE_PAGE));
        $this->setVariable('tabTitle', 'View Request #' . $number);
        $this->setVariables($details);
    }
}
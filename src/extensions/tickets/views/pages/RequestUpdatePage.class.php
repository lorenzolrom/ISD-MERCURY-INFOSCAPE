<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 12:29 PM
 */


namespace extensions\tickets\views\pages;


class RequestUpdatePage extends ModelPage
{
    public function __construct(int $workspace, int $number)
    {
        parent::__construct("tickets/requests/$workspace/$number", 'tickets-customer', 'requests');

        $details = $this->response->getBody();

        $this->setVariable('content', self::templateFileContents('RequestUpdateForm', self::TEMPLATE_FORM, 'tickets'));
        $this->setVariable('tabTitle', 'Update Request #' . $number);
        $this->setVariables($details);
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/16/2019
 * Time: 7:29 AM
 */


namespace views\pages\tickets;


use exceptions\EntryNotFoundException;
use utilities\InfoCentralConnection;

abstract class PopupModelPage extends PopupTicketDocument
{
    protected $response;

    /**
     * PopupModelPage constructor.
     * @param string $path
     * @throws EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(string $path)
    {
        parent::__construct();

        $this->response = InfoCentralConnection::getResponse(InfoCentralConnection::GET, $path);

        if($this->response->getResponseCode() != '200')
            throw new EntryNotFoundException(EntryNotFoundException::MESSAGES[EntryNotFoundException::PRIMARY_KEY_NOT_FOUND], EntryNotFoundException::PRIMARY_KEY_NOT_FOUND);
    }
}
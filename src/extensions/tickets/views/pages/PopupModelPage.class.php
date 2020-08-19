<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 9/16/2019
 * Time: 7:29 AM
 */


namespace extensions\tickets\views\pages;


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

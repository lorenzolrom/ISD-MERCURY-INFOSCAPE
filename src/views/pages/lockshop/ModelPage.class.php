<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/13/2019
 * Time: 2:26 PM
 */


namespace views\pages\lockshop;


use exceptions\EntryNotFoundException;
use utilities\InfoCentralConnection;

class ModelPage extends LIMSDocument
{
    protected $response;

    /**
     * ModelPage constructor.
     * @param string $path
     * @param string|null $permission
     * @param string|null $section
     * @throws EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(string $path, ?string $permission = NULL, ?string $section = NULL)
    {
        parent::__construct($permission, $section);

        $this->response = InfoCentralConnection::getResponse(InfoCentralConnection::GET, $path);

        if($this->response->getResponseCode() != '200')
            throw new EntryNotFoundException(EntryNotFoundException::MESSAGES[EntryNotFoundException::PRIMARY_KEY_NOT_FOUND], EntryNotFoundException::PRIMARY_KEY_NOT_FOUND);
    }
}
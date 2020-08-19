<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 4:56 PM
 */


namespace models;


class HTTPRequest
{
    private $uriParts;

    /**
     * HTTPRequest constructor.
     * @param array $uriParts
     */
    public function __construct(array $uriParts)
    {
        $this->uriParts = $uriParts;
    }

    /**
     * @return string|null
     */
    public function next(): ?string
    {
        return array_shift($this->uriParts);
    }

    /**
     * @return array
     */
    public function getUriParts(): array
    {
        return $this->uriParts;
    }
}

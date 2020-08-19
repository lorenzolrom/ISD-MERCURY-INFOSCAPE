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
 * Time: 4:48 PM
 */


namespace utilities;

/**
 * Class URIParser
 *
 * Uses configuration settings to generate the requested URI
 *
 * @package utilities
 */
class URIParser
{
    /**
     * @return array
     */
    public static function getURIParts(): array
    {
        // Remove baseURI
        $pos = strpos($_SERVER['REQUEST_URI'], \Config::OPTIONS['baseURI']);
        $reqURI = substr_replace($_SERVER['REQUEST_URI'], '', $pos, strlen(\Config::OPTIONS['baseURI']));

        // Remove Query Params and convert to lowercase
        $reqURI = strtolower(explode('?', $reqURI)[0]);

        // Remove Query Params
        $reqURI = explode('?', $reqURI)[0];

        // Remove trailing slash
        $reqURI = rtrim($reqURI, '/');

        // Break up into parts
        $reqURI = explode('/', $reqURI);

        return $reqURI;
    }
}

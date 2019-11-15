<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
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
        // Remove the baseURI and convert to lowercase
        $reqURI = explode(\Config::OPTIONS['baseURI'], strtolower($_SERVER['REQUEST_URI']))[1];

        // Remove Query Params
        $reqURI = explode('?', $reqURI)[0];

        // Remove trailing slash
        $reqURI = rtrim($reqURI, '/');

        // Break up into parts
        $reqURI = explode('/', $reqURI);

        return $reqURI;
    }
}
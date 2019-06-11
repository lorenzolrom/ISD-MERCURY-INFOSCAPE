<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 4:48 PM
 */


namespace views\elements;

class NetCenterNavigation extends Navigation
{
    /**
     * Navigation constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct('', \Pages::HEADER);
    }
}
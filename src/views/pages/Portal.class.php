<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/31/2019
 * Time: 2:47 PM
 */


namespace views\pages;

use views\elements\PortalMenu;

/**
 * Class Portal
 *
 * Main application landing page
 *
 * @package views\pages
 */
class Portal extends PortalDocument
{
    public function __construct()
    {
        parent::__construct();
        $this->setVariable("tabTitle", 'Portal');

        $menu = new PortalMenu();
        $this->setVariable('content', $menu->getTemplate());
    }
}

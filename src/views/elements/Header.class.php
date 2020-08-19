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
 * Time: 7:39 PM
 */


namespace views\elements;

use views\View;

class Header extends View
{
    /**
     * Header constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML("Header", self::TEMPLATE_ELEMENT);
        $this->setVariable('companyName', \Config::OPTIONS['companyName']);
    }
}

<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 10:08 AM
 */


namespace views\pages;


use views\View;

abstract class HTML5Document extends View
{
    /**
     * HTML5Document constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML("HTML5Document", self::TEMPLATE_PAGE);
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 5:01 PM
 */


namespace views\pages;


use views\View;

class LoginPage extends View
{
    /**
     * LoginPage constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML("HTML5Document", self::TEMPLATE_PAGE);
        $this->setVariable("content", self::templateFileContents("LoginForm", self::TEMPLATE_FORM));
        $this->setVariable("tabTitle", "Login");
    }
}
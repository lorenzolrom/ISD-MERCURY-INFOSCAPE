<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 8:16 PM
 */


namespace views\pages;


abstract class ApplicationPage extends UserDocument
{
    public function __construct(?string $permission = NULL)
    {
        parent::__construct($permission);

        $this->setVariable("content", self::templateFileContents("ApplicationPage", self::TEMPLATE_PAGE));
    }
}
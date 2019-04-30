<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 4:52 PM
 */


namespace views\pages;


use views\elements\Header;
use views\View;

class PublicDocument extends View
{
    /**
     * PublicDocument constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('HTML5Document', self::TEMPLATE_PAGE);

        $this->setVariable("content", self::templateFileContents("UserDocument", self::TEMPLATE_PAGE));

        $header = new Header();
        $this->setVariable('header', $header->getTemplate());
        $this->setVariable('footer', self::templateFileContents('Footer', self::TEMPLATE_ELEMENT));
    }
}
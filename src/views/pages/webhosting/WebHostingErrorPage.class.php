<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/13/2019
 * Time: 3:21 PM
 */


namespace views\pages\webhosting;


use views\pages\UserDocument;

class WebHostingErrorPage extends UserDocument
{
    public function __construct(\Exception $e)
    {
        parent::__construct();

        $this->setVariable("content", self::templateFileContents("Error", self::TEMPLATE_CONTENT));
        $this->setVariable("tabTitle", "Error");
        $this->setVariable("errorMessage", $e->getMessage());
    }
}
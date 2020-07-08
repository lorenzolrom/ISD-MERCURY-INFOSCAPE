<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 8:52 PM
 */


namespace views\pages;

class ErrorPage extends PortalDocument
{
    public function __construct(\Exception $e)
    {
        parent::__construct();

        $this->setVariable("content", self::templateFileContents("Error", self::TEMPLATE_CONTENT));
        $this->setVariable("tabTitle", "Error");
        $this->setVariable("errorMessage", $e->getMessage());
    }
}

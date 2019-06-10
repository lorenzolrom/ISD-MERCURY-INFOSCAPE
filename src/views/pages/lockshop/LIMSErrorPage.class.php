<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/24/2019
 * Time: 3:36 PM
 */


namespace views\pages\lockshop;


class LIMSErrorPage extends LIMSDocument
{
    public function __construct(\Exception $e)
    {
        parent::__construct();

        $this->setVariable("content", self::templateFileContents("Error", self::TEMPLATE_CONTENT));
        $this->setVariable("tabTitle", "Error");
        $this->setVariable("errorMessage", $e->getMessage());
    }
}
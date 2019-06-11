<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:23 PM
 */


namespace views\pages\facilities;


class FacilitiesErrorDocument extends FacilitiesDocument
{
    public function __construct(\Exception $e)
    {
        parent::__construct();

        $this->setVariable("content", self::templateFileContents("Error", self::TEMPLATE_CONTENT));
        $this->setVariable("tabTitle", "Error");
        $this->setVariable("errorMessage", $e->getMessage());
    }
}
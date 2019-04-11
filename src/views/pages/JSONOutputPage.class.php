<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 9:38 PM
 */


namespace views\pages;

/**
 * Class JSONOutputPage
 *
 * A page for outputting json
 *
 * @package views\pages
 */
class JSONOutputPage extends AuthenticatedPage
{
    public function __construct(string $json)
    {
        parent::__construct();

        $this->setTemplate($json);
    }
}
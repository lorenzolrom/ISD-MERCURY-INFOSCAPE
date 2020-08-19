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
 * Time: 9:38 PM
 */


namespace views\pages;

use views\View;

/**
 * Class JSONOutputPage
 *
 * A page for outputting json
 *
 * @package views\pages
 */
class JSONOutputPage extends View
{
    public function __construct(string $json)
    {
        $this->setTemplate($json);
    }
}

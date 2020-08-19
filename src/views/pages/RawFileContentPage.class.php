<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 10/30/2019
 * Time: 3:52 PM
 */


namespace views\pages;


use views\View;

class RawFileContentPage extends View
{
    public function __construct($path)
    {
        self::setTemplate(file_get_contents($path));
    }
}

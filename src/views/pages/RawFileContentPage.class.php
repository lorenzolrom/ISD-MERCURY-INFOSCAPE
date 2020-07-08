<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
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

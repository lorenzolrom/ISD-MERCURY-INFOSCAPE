<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 10/31/2019
 * Time: 9:51 AM
 */


namespace controllers;


use views\pages\RawFileContentPage;
use views\View;

class StylesheetController extends Controller
{

    /**
     * @return View
     */
    public function getPage(): ?View
    {
        $scriptPath = dirname(__FILE__) . '/../';

        // Check for extension prefix
        $extension = $this->request->next();

        if(in_array($extension, \Config::OPTIONS['enabledExtensions']))
        {
            $scriptPath .= 'extensions/' . $extension . '/stylesheets';
        }
        else
        {
            $scriptPath .= 'stylesheets/' . $extension;
        }

        while($part = $this->request->next())
        {
            $scriptPath .= '/' . $part;
        }

        if(file_exists($scriptPath))
        {
            header('Content-type: text/css');
            return new RawFileContentPage($scriptPath);
        }

        return NULL;
    }
}

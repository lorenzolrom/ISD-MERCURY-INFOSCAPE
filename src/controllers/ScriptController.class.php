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
 * Time: 2:38 PM
 */


namespace controllers;


use views\pages\RawFileContentPage;
use views\View;

/**
 * Class ScriptController
 *
 * Serves script files buried in extensions
 *
 * @package controllers
 */
class ScriptController extends Controller
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
            $scriptPath .= 'extensions/' . $extension . '/scripts';
        }
        else
        {
            $scriptPath .= 'scripts/' . $extension;
        }

        while($part = $this->request->next())
        {
            $scriptPath .= '/' . $part;
        }

        if(file_exists($scriptPath))
        {
            // Set MIME type
            $ext = pathinfo($scriptPath, PATHINFO_EXTENSION);

            if($ext == 'css')
                header('Content-type: text/css');
            else
                header('Content-type: application/javascript');

            return new RawFileContentPage($scriptPath);
        }

        return NULL;
    }
}

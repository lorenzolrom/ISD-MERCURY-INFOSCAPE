<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 5/13/2020
 * Time: 6:09 PM
 */


namespace controllers;


use views\pages\RawFileContentPage;
use views\View;

/**
 * Serve media stored in an extension's directory
 *
 * Class ExtensionMediaController
 * @package controllers
 */
class ExtensionMediaController extends Controller
{
    // Define what MIME type will be returned for specified extensions
    private const EXTENSION_MIMETYPE_MAP = array(
        'png' => 'image/png',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpg',
        'svg' => 'image/svg+xml',
        'gif' => 'image/gif'
    );

    /**
     * @return View
     */
    public function getPage(): ?View
    {
        $resourcePath = dirname(__FILE__) . '/../';

        // Check for extension prefix
        $extension = $this->request->next();

        if(in_array($extension, \Config::OPTIONS['enabledExtensions']))
        {
            $resourcePath .= 'extensions/' . $extension . '/media';

            // Add additional parts of request
            while($part = $this->request->next())
            {
                $resourcePath .= '/' . $part;
            }

            // Check that file exists
            if(file_exists($resourcePath))
            {
                // Get file extension
                $fileExt = strtolower(pathinfo($resourcePath, PATHINFO_EXTENSION));

                if(in_array($fileExt, array_keys(self::EXTENSION_MIMETYPE_MAP)))
                {
                    $contentType = self::EXTENSION_MIMETYPE_MAP[$fileExt];

                    header('Content-type: ' . $contentType);

                    return new RawFileContentPage($resourcePath);
                }
            }
        }

        return NULL;
    }
}
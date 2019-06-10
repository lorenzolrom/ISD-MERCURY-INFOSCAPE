<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/11/2019
 * Time: 5:01 PM
 */


namespace views\elements;


use utilities\InfoCentralConnection;
use views\View;

/**
 * Class Sidebar
 *
 * A sidebar that displays pages the current user has access to in the section they're in
 *
 * @package views\elements
 */
class Sidebar extends View
{
    /**
     * Sidebar constructor.
     * @param string $sectionTitle
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct(string $sectionTitle)
    {
        $this->setTemplateFromHTML("Sidebar", self::TEMPLATE_ELEMENT);

        if(!isset(\Pages::HEADER[$sectionTitle]))
            return;

        $section = \Pages::HEADER[$sectionTitle];

        $this->setVariable("sectionTitle", $section['title']);
        $this->setVariable('sectionIcon', $section['icon']);

        if(!isset($section['pages']))
            return;

        $permissions = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser/permissions")->getBody();
        $links = "";

        foreach($section['pages'] as $page)
        {
            if(isset($page['icon']))
                $icon = "<img alt='' src='{{@baseURI}}media/icons/{$page['icon']}'>";
            else
                $icon = "";

            if(in_array($page['permission'], $permissions))
                $links .= "<li><a href='{{@baseURI}}{$page['link']}'>$icon{$page['title']}</a></li>\n";
        }

        $this->setVariable("sectionLinks", $links);
    }
}
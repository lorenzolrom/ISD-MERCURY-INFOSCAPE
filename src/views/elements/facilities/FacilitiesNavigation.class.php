<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:10 PM
 */


namespace views\elements\facilities;


use utilities\InfoCentralConnection;
use views\View;

class FacilitiesNavigation extends View
{
    private const LINKS = array(
        'buildings' => array(
            'title' => 'Buildings',
            'permission' => 'facilitiescore_facilities-r',
            'icon' => 'building.png',
            'link' => 'buildings'
        ),
    );

    /**
     * TicketNavigation constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('Navigation', self::TEMPLATE_ELEMENT);
        $permissions = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser/permissions")->getBody();

        $navigation = '';

        foreach(self::LINKS as $section)
        {
            if(!in_array($section['permission'], $permissions))
                continue;

            if(isset($section['link']))
                $sectionString = "<li><a class='nav-item' href='{{@baseURI}}facilities/{$section['link']}'><img src='{{@baseURI}}media/icons/{$section['icon']}' alt=''>{$section['title']}</a>\n";
            else
                $sectionString = "<li><span class='nav-item'><img src='{{@baseURI}}media/icons/{$section['icon']}' alt=''>{$section['title']}</span>\n";

            if(isset($section['pages']))
            {
                $sectionString .= "<ul>\n";

                foreach($section['pages'] as $page)
                {
                    if(!in_array($page['permission'], $permissions))
                        continue;

                    if(isset($page['icon']))
                        $icon = "<img src='{{@baseURI}}media/icons/{$page['icon']}' alt=''>";
                    else
                        $icon = "";

                    $sectionString .= "<li><a href='{{@baseURI}}facilities/{$page['link']}'>" . $icon . "{$page['title']}</a></li>";
                }

                $sectionString .= "</ul>\n";
            }

            $sectionString .= "</li>";

            $navigation .= $sectionString;
        }

        $this->setVariable("navigation", $navigation);
    }
}
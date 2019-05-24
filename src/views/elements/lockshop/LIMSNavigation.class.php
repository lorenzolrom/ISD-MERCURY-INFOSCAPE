<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/24/2019
 * Time: 3:30 PM
 */


namespace views\elements\lockshop;


use utilities\InfoCentralConnection;
use views\View;

class LIMSNavigation extends View
{
    private const LINKS = array(
        'systems' => array(
            'title' => 'Systems',
            'permission' => 'lockshop-r',
            'link' => 'systems',
            'icon' => 'operator.png'
        ),
        'locks' => array(
            'title' => 'Search Locks',
            'permission' => 'lockshop-r',
            'link' => 'locks',
            'icon' => 'operator.png'
        ),
        'keys' => array(
            'title' => 'Search Keys',
            'permission' => 'lockshop-r',
            'link' => 'keys',
            'icon' => 'operator.png'
        ),
    );

    /**
     * TicketNavigation constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('lockshop/LIMSNavigation', self::TEMPLATE_ELEMENT);
        $permissions = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser/permissions")->getBody();

        $navigation = '';

        foreach(self::LINKS as $section)
        {
            if(!in_array($section['permission'], $permissions))
                continue;

            if(isset($section['link']))
                $sectionString = "<li><a class='nav-item' href='{{@baseURI}}lockshop/{$section['link']}'><img src='{{@baseURI}}media/icons/{$section['icon']}' alt=''>{$section['title']}</a>\n";
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

                    $sectionString .= "<li><a href='{{@baseURI}}lockshop/{$page['link']}'>" . $icon . "{$page['title']}</a></li>";
                }

                $sectionString .= "</ul>\n";
            }

            $sectionString .= "</li>";

            $navigation .= $sectionString;
        }

        $this->setVariable("navigation", $navigation);
    }
}
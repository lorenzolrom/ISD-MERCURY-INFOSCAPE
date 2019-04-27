<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 7:39 PM
 */


namespace views\elements;


use models\User;
use utilities\InfoCentralConnection;
use views\View;

class Header extends View
{
    /**
     * Header constructor.
     * @param User $user
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct(User $user)
    {
        $this->setTemplateFromHTML("Header", self::TEMPLATE_ELEMENT);

        // Generate 'navigation' from items listed in Pages.class
        $permissions = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser/permissions")->getBody();

        $navigation = "";

        foreach(\Pages::HEADER as $section)
        {
            if(!in_array($section['permission'], $permissions))
                continue;

            if(isset($section['link']))
                $sectionString = "<li><a class='nav-item' href='{{@baseURI}}{$section['link']}'><img src='{{@baseURI}}media/icons/{$section['icon']}' alt=''>{$section['title']}</a>\n";
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

                    $sectionString .= "<li><a href='{{@baseURI}}{$page['link']}'>" . $icon . "{$page['title']}</a></li>";
                }

                $sectionString .= "</ul>\n";
            }

            $sectionString .= "</li>";

            $navigation .= $sectionString;
        }

        $this->setVariable("navigation", $navigation);
        $this->setVariable("operatorUsername", $user->getUsername());
    }
}
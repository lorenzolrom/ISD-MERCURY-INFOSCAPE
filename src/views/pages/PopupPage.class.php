<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/26/2019
 * Time: 9:07 AM
 */


namespace views\pages;

/**
 * Class PopupPage
 *
 * A page with no header or footer.
 * This is designed for popup dialogs
 *
 * @package views\pages
 */
abstract class PopupPage extends AuthenticatedPage
{
    /**
     * PopupPage constructor.
     * @param string|null $permission
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL)
    {
        parent::__construct($permission);

        $this->setTemplateFromHTML("HTML5Document", self::TEMPLATE_PAGE);
    }
}
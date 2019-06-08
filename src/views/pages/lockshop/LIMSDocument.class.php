<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/24/2019
 * Time: 3:27 PM
 */


namespace views\pages\lockshop;


use views\elements\lockshop\LIMSNavigation;
use views\pages\UserDocument;

abstract class LIMSDocument extends UserDocument
{
    /**
     * LIMSDocument constructor.
     * @param string|null $permission
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $permission = NULL)
    {
        parent::__construct($permission);

        $navigation = new LIMSNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
        $this->setVariable('sidebar', self::templateFileContents('Sidebar', self::TEMPLATE_ELEMENT));
    }
}
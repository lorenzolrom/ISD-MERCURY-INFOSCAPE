<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 12:08 AM
 */


namespace views\pages\admin;


use views\pages\MainDocument;

class APIKeyListPage extends MainDocument
{
    /**
     * APIKeySearchPage constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct('api-settings', 'admin');

        $this->setVariable('tabTitle', 'API Keys');
        $this->setVariable('content', self::templateFileContents('admin/APIKeyListPage', self::TEMPLATE_PAGE));
    }
}
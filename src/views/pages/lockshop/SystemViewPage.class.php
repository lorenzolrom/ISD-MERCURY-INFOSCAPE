<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/13/2019
 * Time: 2:32 PM
 */


namespace views\pages\lockshop;


class SystemViewPage extends ModelPage
{
    /**
     * SystemViewPage constructor.
     * @param int $id
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(int $id)
    {
        parent::__construct("lockshop/systems/$id", 'lockshop-r', 'systems');

        $details = $this->response->getBody();

        $this->setVariable('content', self::templateFileContents('lockshop/SystemViewPage', self::TEMPLATE_PAGE));
        $this->setVariable('tabTitle', 'System - ' . $details['name']);
        $this->setVariables($details);
    }
}
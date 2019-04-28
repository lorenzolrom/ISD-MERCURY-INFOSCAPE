<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 8:41 PM
 */


namespace views\pages\itsm;


use views\pages\ApplicationPage;

class HostSearchPage extends ApplicationPage
{
    public function __construct()
    {
        parent::__construct("itsm_devices-hosts-r", 'devices');

        $this->setVariable('tabTitle', 'Hosts');
        $this->setVariable('content', self::templateFileContents('itsm/HostSearchPage', self::TEMPLATE_CONTENT));
    }
}
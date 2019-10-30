<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/03/2019
 * Time: 10:00 PM
 */


namespace extensions\netcenter\views\pages\ait;


use extensions\netcenter\views\pages\ModelPage;

class ApplicationViewPage extends ModelPage
{
    public function __construct(?string $appNum)
    {
        parent::__construct("applications/$appNum", 'itsm_ait-apps-r', 'ait');

        $details = $this->response->getBody();

        $this->setVariable('content', self::templateFileContents('ait/Application', self::TEMPLATE_PAGE, 'netcenter'));
        $this->setVariable('tabTitle', 'Application - ' . htmlentities($details['name']));

        $this->setVariable('publicFacing', $details['publicFacing'] ? 'Yes' : 'No');
        $this->setVariables($details);

        // Web hosts
        $webHosts = "";

        foreach($details['webHosts'] as $webHost)
        {
            $webHosts .= "<li><a href='{{@baseURI}}netcenter/devices/hosts/{$webHost['id']}'><img src='{{@baseURI}}media/icons/interface.png' alt=''>{$webHost['systemName']} ({$webHost['ipAddress']})</a></li>";
        }

        $this->setVariable('webHostList', $webHosts);

        // Data hosts
        $dataHosts = "";

        foreach($details['dataHosts'] as $dataHost)
        {
            $dataHosts .= "<li><a href='{{@baseURI}}netcenter/devices/hosts/{$dataHost['id']}'><img src='{{@baseURI}}media/icons/interface.png' alt=''>{$dataHost['systemName']} ({$dataHost['ipAddress']})</a></li>";
        }

        $this->setVariable('dataHostList', $dataHosts);

        // App hosts
        $appHosts = "";

        foreach($details['appHosts'] as $appHost)
        {
            $appHosts .= "<li><a href='{{@baseURI}}netcenter/devices/hosts/{$appHost['id']}'><img src='{{@baseURI}}media/icons/interface.png' alt=''>{$appHost['systemName']} ({$appHost['ipAddress']})</a></li>";
        }

        $this->setVariable('appHostList', $appHosts);

        // V hosts
        $vhosts = "";

        foreach($details['vHosts'] as $vhost)
        {
            $vhosts .= "<li><a href='{{@baseURI}}netcenter/web/vhosts/{$vhost['id']}'><img src='{{@baseURI}}media/icons/hostname.png' alt=''>{$vhost['subdomain']}.{$vhost['domain']}</a></li>";
        }

        $this->setVariable('vhostList', $vhosts);
    }
}
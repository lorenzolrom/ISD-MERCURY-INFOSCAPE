<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 11:03 AM
 */


namespace views\forms\netcenter\ait;


use utilities\InfoCentralConnection;
use views\forms\Form;

class ApplicationForm extends Form
{
    /**
     * ApplicationForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML("ait/ApplicationForm", self::TEMPLATE_FORM);

        $types = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'applications/types')->getBody();
        $lifeExpectancies = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'applications/lifeExpectancies')->getBody();
        $dataVolumes = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'applications/dataVolumes')->getBody();
        $authTypes = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'applications/authTypes')->getBody();
        $statuses = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'applications/statuses')->getBody();

        $this->setVariable('typeSelect', self::generateAttributeOptions($types, isset($details) ? $details['type'] : NULL));
        $this->setVariable('lifeExpectancySelect', self::generateAttributeOptions($lifeExpectancies, isset($details) ? $details['lifeExpectancy'] : NULL));
        $this->setVariable('authTypeSelect', self::generateAttributeOptions($authTypes, isset($details) ? $details['authType'] : NULL));
        $this->setVariable('dataVolumeSelect', self::generateAttributeOptions($dataVolumes, isset($details) ? $details['dataVolume'] : NULL));
        $this->setVariable('statusSelect', self::generateAttributeOptions($statuses, isset($details) ? $details['status'] : NULL));

        if($details !== NULL)
        {
            $this->setVariables($details);

            if($details['publicFacing'])
                $this->setVariable('publicFacingYes', 'selected');
        }

        // 3x Host Select
        $hosts = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'hosts')->getBody();

        foreach(array('app', 'web', 'data') as $hostType)
        {
            $hostSelect = "";

            foreach($hosts as $host)
            {
                $selected = '';

                if($details !== NULL)
                {
                    foreach($details[$hostType . 'Hosts'] as $assignedHost)
                    {
                        if($host['id'] == $assignedHost['id'])
                            $selected = 'selected';
                    }
                }

                $hostSelect .= "<option value='{$host['id']}' $selected>{$host['systemName']} ({$host['ipAddress']})</option>";
            }

            $this->setVariable($hostType . 'HostSelect', $hostSelect);
        }

        // Virtual Host Select
        $vhosts = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'vhosts')->getBody();

        $vhostSelect = "";

        foreach($vhosts as $vhost)
        {
            $selected = '';
            if($details !== NULL)
            {
                foreach($details['vHosts'] as $assignedVhost)
                {
                    if($vhost['id'] == $assignedVhost['id'])
                        $selected = 'selected';
                }
            }

            $vhostSelect .= "<option value='{$vhost['id']}' $selected>{$vhost['subdomain']}.{$vhost['domain']}</option>";
        }

        $this->setVariable('vHostSelect', $vhostSelect);
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 9:19 PM
 */


namespace views\forms\netcenter\devices;


use views\forms\Form;

class HostForm extends Form
{
    /**
     * HostForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('devices/HostForm', self::TEMPLATE_FORM);

        if($details !== NULL)
        {
            $this->setVariable('ipAddress', $details['ipAddress']);
            $this->setVariable('macAddress', $details['macAddress']);
            $this->setVariable('assetTag', $details['assetTag']);

            $this->setVariable('systemName', htmlentities($details['systemName']));
            $this->setVariable('systemCPU', htmlentities($details['systemCPU']));
            $this->setVariable('systemRAM', htmlentities($details['systemRAM']));
            $this->setVariable('systemOS', htmlentities($details['systemOS']));
            $this->setVariable('systemDomain', htmlentities($details['systemDomain']));
        }
    }
}
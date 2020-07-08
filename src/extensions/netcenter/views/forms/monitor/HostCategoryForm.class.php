<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/06/2019
 * Time: 9:56 AM
 */


namespace extensions\netcenter\views\forms\monitor;


use utilities\InfoCentralConnection;
use views\forms\Form;

class HostCategoryForm extends Form
{
    /**
     * HostCategoryForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('monitor/HostCategoryForm', self::TEMPLATE_FORM, 'netcenter');

        $hosts = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'hosts')->getBody();

        if($details !== NULL)
        {
            $this->setVariables($details);

            if(!$details['displayed'])
                $this->setVariable('displayedNo', 'selected');
        }

        $hostSelect = '';

        foreach($hosts as $host)
        {
            $selected = '';

            if(is_array($details['hosts']))
            {
                foreach($details['hosts'] as $currentHost)
                {
                    if($currentHost['id'] == $host['id'])
                        $selected = 'selected';
                }
            }

            $hostSelect .= "<option value='{$host['id']}' $selected>{$host['systemName']} ({$host['ipAddress']})</option>";
        }

        $this->setVariable('hostSelect', $hostSelect);
    }
}

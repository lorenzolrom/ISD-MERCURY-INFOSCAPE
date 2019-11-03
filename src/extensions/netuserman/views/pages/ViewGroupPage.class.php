<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 4:04 PM
 */


namespace extensions\netuserman\views\pages;

class ViewGroupPage extends ModelPage
{
    /**
     * ViewUserPage constructor.
     * @param string $cn
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(string $cn)
    {
        parent::__construct('netgroupman/' . $cn, 'netuserman-readgroups', 'netGroups');
        $details = $this->response->getBody();

        $cn = urldecode($cn);
        $this->setVariable('tabTitle', 'View Group: ' . $details['cn']);

        $this->setVariable('content', self::templateFileContents('ViewGroupPage', self::TEMPLATE_PAGE, 'netuserman'));

        $this->setVariables($details);

        $memberList = '';

        if(is_array($details['member']))
        {
            foreach($details['member'] as $member)
            {
                $memParts = explode(',', $member);
                $memCN = explode('=', array_shift($memParts))[1];
                $memOU = implode(',', $memParts);

                $memberList .= "<tr><td>$memCN</td><td>$memOU</td></tr>";
            }

            $this->setVariable('memberList', $memberList);
        }
    }
}
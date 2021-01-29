<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
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
     * @param string $guid
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(string $guid)
    {
        parent::__construct('netgroupman/' . $guid, 'netuserman-readgroups', 'netGroups');
        $details = $this->response->getBody();

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

                $memberList .= '<tr><td><a href="' . \Config::OPTIONS['baseURI'] . 'netuserman/view/' . $memCN . '"><i class="icon">account_circle</i>' . $memCN . '</a></td><td>' . $memOU . '</td></tr>';
            }

            $this->setVariable('memberList', $memberList);
        }
    }
}

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

class ViewUserPage extends ModelPage
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
        parent::__construct('netuserman/' . $cn, 'netuserman-read', 'netUsers');
        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'View User: ' . $details['cn']);

        $this->setVariable('content', self::templateFileContents('ViewUserPage', self::TEMPLATE_PAGE, 'netuserman'));

        $this->setVariable('loginname', explode('@', $details['userprincipalname'])[0]);

        // Set image path
        $this->setVariable('thumbnailphotoPath', \Config::OPTIONS['baseURI'] . 'netuserman/photo/' . $cn);

        // Format useraccountcontrol list
        $useraccountcontrolList = '';

        if(is_array($details['useraccountcontrol']))
        {
            foreach($details['useraccountcontrol'] as $flag)
            {
                $useraccountcontrolList .= "<li>$flag</li>";
            }
        }

        $this->setVariable('useraccountcontrolList', $useraccountcontrolList);

        // Format member of list
        $memberofList = '';

        if(is_array($details['memberof']))
        {
            foreach($details['memberof'] as $group)
            {

                $parts = explode(',', $group);

                // Get name
                $name = htmlentities(explode('CN=', array_shift($parts))[1]);
                // Break folder path into DC, CN, and OU
                $ou = implode(',', $parts);

                $memberofList .= '<tr><td><a href="' . \Config::OPTIONS['baseURI'] . 'netuserman/viewgroup/' . $name . '"><i class="icon">group</i>' . $name . '</a></td><td>' . $ou .'</td></tr>';
            }
        }

        // Convert UNIX timestamp of lastlogon to ISO 8601
        if(isset($details['lastlogon']))
        {
            $details['lastlogon'] = date('Y-m-d H:i:s', $details['lastlogon']);
        }

        $this->setVariables($details);
        $this->setVariable('memberofList', $memberofList);
    }
}

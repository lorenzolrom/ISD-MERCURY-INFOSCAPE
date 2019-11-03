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

class ViewUserPage extends ModelPage
{
    /**
     * ViewUserPage constructor.
     * @param string $username
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(string $username)
    {
        parent::__construct('netuserman/' . $username, 'netuserman-read', 'netUsers');
        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'View User: ' . $details['userprincipalname']);

        $this->setVariable('content', self::templateFileContents('ViewUserPage', self::TEMPLATE_PAGE, 'netuserman'));

        $this->setVariable('loginname', explode('@', $details['userprincipalname'])[0]);

        // Set image path
        $this->setVariable('thumbnailphotoPath', \Config::OPTIONS['baseURI'] . 'netuserman/photo/' . $username);

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
                $name = explode('CN=', array_shift($parts))[1];
                // Break folder path into DC, CN, and OU
                $ou = implode(',', $parts);

                $memberofList .= "<tr><td>$name</td><td>$ou</td></tr>";
            }
        }

        $this->setVariables($details);
        $this->setVariable('memberofList', $memberofList);
    }
}
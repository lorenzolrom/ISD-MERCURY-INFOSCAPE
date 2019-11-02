<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 8:38 PM
 */


namespace extensions\netuserman\views\forms;


use views\forms\Form;

class EditUserForm extends Form
{
    private const UAC_FORWARD_LOOKUP = array(
        'SCRIPT' => 1, // Running the login script
        'ACCOUNTDISABLE' => 2, // The account id disabled
        'HOMEDIR_REQUIRED' => 8, // The home folder is required
        'LOCKOUT' => 16, // The account is locked
        'PASSWD_NOTREQD' => 32, // No password required
        'PASSWD_CANT_CHANGE' => 64, // Prevent user from changing password
        'ENCRYPTED_TEXT_PWD_ALLOWED' => 128, // Store password using reversible encryption
        'TEMP_DUPLICATE_ACCOUNT' => 256,
        'NORMAL_ACCOUNT' => 512, // A default account, active
        'INTERDOMAIN_TRUST_ACCOUNT' => 2048,
        'WORKSTATION_TRUST_ACCOUNT' => 4096,
        'SERVER_TRUST_ACCOUNT' => 8192,
        'DONT_EXPIRE_PASSWORD' => 65536,
        'MSN_LOGON_ACCOUNT' => 131072,
        'SMARTCARD_REQUIRED' => 262144,
        'TRUSTED_FOR_DELEGATION' => 524288,
        'NOT_DELEGATED' => 1048576,
        'USE_DES_KEY_ONLY' => 2097152,
        'DONT_REQ_PREAUTH' => 4194304, // Kerberos pre-authentication is not required
        'PASSWORD_EXPIRED'=> 8388608, // The user password has expired
        'TRUSTED_TO_AUTH_FOR_DELEGATION' => 16777216,
        'PARTIAL_SECRETS_ACCOUNT' => 67108864
    );

    /**
     * EditUserForm constructor.
     * @param array|null $vars
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $vars = NULL)
    {
        $this->setTemplateFromHTML('EditUserForm', self::TEMPLATE_FORM, 'netuserman');

        if($vars !== NULL)
            $this->setVariables($vars);

        $this->setVariable('loginname', explode('@', $vars['userprincipalname'])[0]);

        $useraccountcontrolOptions = '';

        foreach(array_keys(self::UAC_FORWARD_LOOKUP) as $flag)
        {
            $selected = '';

            if(is_array($vars['useraccountcontrol']) AND in_array($flag, $vars['useraccountcontrol']))
                $selected = 'selected';

            $useraccountcontrolOptions .= "<option value='$flag' $selected>$flag</option>";
        }

        $this->setVariable('useraccountcontrolOptions', $useraccountcontrolOptions);
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 5/03/2019
 * Time: 12:44 PM
 */


namespace views\pages\web;


use views\pages\ModelPage;

class VHostLogPage extends ModelPage
{
    public function __construct(?string $param)
    {
        parent::__construct("vhosts/$param", 'itsm_weblogs', 'web');

        $this->setVariable('content', self::templateFileContents('web/VHostLogPage', self::TEMPLATE_CONTENT));
        $this->setVariable('tabTitle', "Get Logs - vhost($param)");
        $this->setVariable('id', $param);
    }
}
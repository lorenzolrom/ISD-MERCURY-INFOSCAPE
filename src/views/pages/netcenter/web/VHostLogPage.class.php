<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/03/2019
 * Time: 12:44 PM
 */


namespace views\pages\netcenter\web;


use views\pages\netcenter\ModelPage;

class VHostLogPage extends ModelPage
{
    public function __construct(?string $param)
    {
        parent::__construct("vhosts/$param", 'itsm_weblogs', 'web');

        $this->setVariable('content', self::templateFileContents('web/VHostLogPage', self::TEMPLATE_PAGE));
        $this->setVariable('tabTitle', "Get Logs - vhost($param)");
        $this->setVariable('id', $param);
    }
}
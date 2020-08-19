<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 5/03/2019
 * Time: 12:44 PM
 */


namespace extensions\netcenter\views\pages\web;


use extensions\netcenter\views\pages\ModelPage;

class VHostLogPage extends ModelPage
{
    public function __construct(?string $param)
    {
        parent::__construct("vhosts/$param", 'itsm_weblogs', 'web');

        $this->setVariable('content', self::templateFileContents('web/VHostLogPage', self::TEMPLATE_PAGE, 'netcenter'));
        $this->setVariable('tabTitle', "Get Logs - vhost($param)");
        $this->setVariable('id', $param);
    }
}

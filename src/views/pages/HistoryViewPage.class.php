<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 10:56 PM
 */


namespace views\pages;

class HistoryViewPage extends PortalDocument
{
    public function __construct(string $object, ?string $index = NULL)
    {
        parent::__construct();

        $this->setVariable('content', self::templateFileContents('History', self::TEMPLATE_PAGE));

        $index = urldecode($index);

        $this->setVariable('tabTitle', "Get History - $object($index)");

        $this->setVariable('object', $object);
        $this->setVariable('index', $index);
    }
}

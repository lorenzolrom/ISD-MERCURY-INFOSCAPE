<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 10:56 PM
 */


namespace views\pages;

class HistoryViewPage extends PortalDocument
{
    public function __construct(string $rawObjectName, string $object, string $index)
    {
        parent::__construct();

        $this->setVariable('tabTitle', "Get History - $rawObjectName($index)");
        $this->setVariable('content', self::templateFileContents('History', self::TEMPLATE_PAGE));

        $this->setVariable('object', $object);
        $this->setVariable('index', $index);
    }
}
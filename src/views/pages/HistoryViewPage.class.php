<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 10:56 PM
 */


namespace views\pages;


class HistoryViewPage extends ApplicationPage
{
    public function __construct(string $rawObjectName, string $object, string $index)
    {
        parent::__construct();

        $this->setVariable('tabTitle', "Get History - $rawObjectName($index)");
        $this->setVariable('content', self::templateFileContents('History', self::TEMPLATE_CONTENT));

        $this->setVariable('object', $object);
        $this->setVariable('index', $index);
    }
}
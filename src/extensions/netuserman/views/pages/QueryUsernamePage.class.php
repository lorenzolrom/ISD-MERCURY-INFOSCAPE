<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 3:48 PM
 */


namespace extensions\netuserman\views\pages;


class QueryUsernamePage extends NetUserManDocument
{
    public function __construct()
    {
        parent::__construct('netuserman-read', 'queryLDAP');

        $this->setVariable('tabTitle', 'Query User');
        $this->setVariable('content', self::templateFileContents('QueryUsernamePage', self::TEMPLATE_PAGE, 'netuserman'));
    }
}
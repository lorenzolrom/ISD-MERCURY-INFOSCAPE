<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 4/30/2019
 * Time: 6:02 PM
 */


namespace views\pages;


class InternalInfoPage extends PublicDocument
{
    public function __construct()
    {
        parent::__construct(TRUE);

        $this->setVariable('tabTitle', 'Internal Information Page (Test)');
    }
}
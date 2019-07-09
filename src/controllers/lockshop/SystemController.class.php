<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/13/2019
 * Time: 12:06 PM
 */


namespace controllers\lockshop;


use controllers\Controller;
use views\pages\lockshop\SystemCreatePage;
use views\pages\lockshop\SystemEditPage;
use views\pages\lockshop\SystemSearchPage;
use views\pages\lockshop\SystemViewPage;
use views\View;

class SystemController extends Controller
{

    /**
     * @return null|View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\EntryNotFoundException
     */
    public function getPage(): ?View
    {
        $param = $this->request->next();
        if($param === NULL)
            return new SystemSearchPage();
        else if($param === 'new')
            return new SystemCreatePage();
        else
        {
            if($this->request->next() == 'edit')
                return new SystemEditPage((int) $param);
            return new SystemViewPage((int)$param);
        }

    }
}
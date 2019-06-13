<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/13/2019
 * Time: 12:06 PM
 */


namespace controllers\lockshop;


use controllers\Controller;
use views\pages\lockshop\SystemSearchPage;
use views\View;

class SystemController extends Controller
{

    /**
     * @return null|View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        if($this->request->next() === NULL)
            return new SystemSearchPage();

        return NULL;
    }
}
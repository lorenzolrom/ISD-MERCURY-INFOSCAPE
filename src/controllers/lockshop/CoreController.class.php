<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury InfoScape
 *
 * User: lromero
 * Date: 6/17/2019
 * Time: 12:57 PM
 */


namespace controllers\lockshop;


use controllers\Controller;
use views\pages\lockshop\CoreEditPage;
use views\View;

class CoreController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        $param = $this->request->next();

        return new CoreEditPage((int)$param);
    }
}
<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 8:31 AM
 */


namespace extensions\tickets\controllers;


use controllers\Controller;
use exceptions\ParameterException;
use extensions\tickets\views\pages\RequestCreatePage;
use extensions\tickets\views\pages\RequestPage;
use extensions\tickets\views\pages\RequestUpdatePage;
use extensions\tickets\views\pages\RequestViewPage;
use views\View;

class RequestController extends Controller
{
    /**
     * @return View
     * @throws ParameterException
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        $param = $this->request->next();

        switch($param)
        {
            case 'new':
                return new RequestCreatePage();
            case NULL:
                return new RequestPage();
            default:
                $parts = explode('-', $param);

                if(sizeof($parts) !== 2)
                    throw new ParameterException(ParameterException::MESSAGES[ParameterException::PARAMETER_INVALID], ParameterException::PARAMETER_INVALID);

                $workspace = (int)$parts[0];
                $number = (int)$parts[1];

                if($this->request->next() == 'update')
                    return new RequestUpdatePage($workspace, $number);

                return new RequestViewPage($workspace, $number);
        }
    }
}

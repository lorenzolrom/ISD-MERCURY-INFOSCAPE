<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 9/15/2019
 * Time: 8:31 AM
 */


namespace controllers\tickets;


use controllers\Controller;
use exceptions\ParameterException;
use views\pages\tickets\RequestCreatePage;
use views\pages\tickets\RequestPage;
use views\pages\tickets\RequestUpdatePage;
use views\pages\tickets\RequestViewPage;
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
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
 * Time: 11:01 PM
 */


namespace controllers;


use exceptions\ParameterException;
use views\pages\HistorySearchPage;
use views\pages\HistoryViewPage;
use views\View;

class HistoryController extends Controller
{


    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws ParameterException
     */
    public function getPage(): ?View
    {
        $object = $this->request->next();
        $index = $this->request->next();

        if($object === 'search')
            return new HistorySearchPage();
        if($object === NULL)
            throw new ParameterException(ParameterException::MESSAGES[ParameterException::URI_PARAMETER_MISSING], ParameterException::URI_PARAMETER_MISSING);

        return new HistoryViewPage($object, $index);
    }
}

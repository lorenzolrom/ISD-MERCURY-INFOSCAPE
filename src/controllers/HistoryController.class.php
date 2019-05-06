<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/27/2019
 * Time: 11:01 PM
 */


namespace controllers;


use exceptions\ParameterException;
use views\pages\HistoryViewPage;
use views\View;

class HistoryController extends Controller
{
    private const OBJECTS = array(
        'hostcategory' => 'ITSM_HostCategory',
        'building' => 'FacilitiesCore_Building',
        'location' => 'FacilitiesCore_Location',
        'asset' => 'ITSM_Asset',
        'commodity' => 'ITSM_Commodity',
        'host' => 'ITSM_Host',
        'vendor' => 'ITSM_Vendor',
        'warehouse' => 'ITSM_Warehouse',
        'registrar' => 'ITSM_Registrar',
        'vhost' => 'ITSM_VHost',
        'urlalias' => 'NIS_URLAlias',
        'application' => 'ITSM_Application',
        'bulletin' => 'Bulletin',
        'role' => 'Role',
        'secret' => 'Secret',
        'user' => 'User'
    );

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws ParameterException
     */
    public function getPage(): View
    {
        $object = $this->request->next();
        $index = $this->request->next();

        if($object === NULL OR $index === NULL)
            throw new ParameterException(ParameterException::MESSAGES[ParameterException::URI_PARAMETER_MISSING], ParameterException::URI_PARAMETER_MISSING);

        if(!in_array($object, array_keys(self::OBJECTS)))
            throw new ParameterException(ParameterException::MESSAGES[ParameterException::PARAMETER_INVALID], ParameterException::PARAMETER_INVALID);

        return new HistoryViewPage($object, self::OBJECTS[$object], $index);
    }
}
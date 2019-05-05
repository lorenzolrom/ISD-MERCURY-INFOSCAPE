<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 9:38 PM
 */


namespace controllers;


use utilities\InfoCentralConnection;
use views\pages\JSONOutputPage;
use views\View;

/**
 * Class ProxyController
 *
 * Utility for javascript to make calls to InfoCentral
 *
 * @package controllers
 */
class APIProxyController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     */
    public function getPage(): View
    {
        $json = json_encode(array('code' => '500', 'data' => array('errors' => array('Invalid Request'))));

        if(isset($_GET['requestType']) AND isset($_GET['path']) AND !empty($_POST['data']))
        {
            // Currently this script is only allowed to perform GET requests, although the request type must still be
            // specified for future-proofing
            switch($_GET['requestType'])
            {
                case "DELETE":
                    $type = InfoCentralConnection::DELETE;
                    break;
                case "PUT":
                    $type = InfoCentralConnection::PUT;
                    break;
                case "POST":
                    $type = InfoCentralConnection::POST;
                    break;
                default:
                    $type = InfoCentralConnection::GET;
            }

            $path = $_GET['path'];

            $body = json_decode($_POST['data'], TRUE);

            // Ensure body was decoded successfully
            if($body !== NULL AND is_array($body))
            {
                $result = InfoCentralConnection::getResponse($type, $path, $body);

                $json = json_encode(array('code' => $result->getResponseCode(), 'data' => $result->getBody()));
            }
        }

        return new JSONOutputPage($json);
    }
}
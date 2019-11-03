<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 11/03/2019
 * Time: 12:03 PM
 */


namespace extensions\facilities\controllers;


use controllers\Controller;
use extensions\facilities\views\pages\CreateFloorplanPage;
use views\View;

class FloorplanController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        $param = $this->request->next();

        if($param === 'create')
            return $this->createFloorPlan();

        return NULL;
    }

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    private function createFloorPlan(): View
    {
        $page = new CreateFloorplanPage($_POST);

        if(!empty($_POST))
        {
            if(!isset($_FILES['floorplanImage']) OR $_FILES['floorplanImage']['size'] === 0)
            {
                $page->setErrors(array('Image required'));
                return $page;
            }

            $headers = array(
                'Secret: ' . \Config::OPTIONS['icSecret']
            );

            if(isset($_COOKIE[\Config::OPTIONS['cookieName']]))
                $headers[] = 'Token: ' . $_COOKIE[\Config::OPTIONS['cookieName']];

            $link = curl_init(\Config::OPTIONS['icURL'] . 'floorplans');
            curl_setopt($link, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($link, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($link, CURLOPT_POST, true);
            curl_setopt(
                $link,
                CURLOPT_POSTFIELDS,
                array(
                    'floorplanImage' => curl_file_create($_FILES['floorplanImage']['tmp_name'], $_FILES['floorplanImage']['type'], basename($_FILES['floorplanImage']['name'])),
                    'buildingCode' => $_POST['buildingCode'],
                    'floor' => $_POST['floor']
                )
            );

            $response = json_decode(curl_exec($link), TRUE);
            $responseCode = curl_getinfo($link, CURLINFO_HTTP_CODE);
            curl_close($link);

            if($responseCode !== 201 AND isset($response['errors']))
                $page->setErrors($response['errors']);
        }

        return $page;
    }
}
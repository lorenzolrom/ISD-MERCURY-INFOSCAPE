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
use extensions\facilities\views\pages\FloorplanCreatePage;
use extensions\facilities\views\pages\FloorplanEditPage;
use extensions\facilities\views\pages\FloorplanPage;
use extensions\facilities\views\pages\FloorplanSearchPage;
use models\HTTPResponse;
use views\View;

class FloorplanController extends Controller
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

        if($param === 'new')
            return $this->createFloorPlan();
        else if($param === NULL)
            return new FloorplanSearchPage();
        else if($param === 'image')
            return $this->getFloorplanPhoto((int)$this->request->next());
        else
        {
            // Edit
            if($this->request->next() === 'edit')
                return new FloorplanEditPage((int)$param);

            // Update image
            if(!empty($_FILES))
                return $this->updateFloorplanImage((int)$param);

            // View
            return new FloorplanPage((int)$param);
        }
    }

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    private function createFloorPlan(): View
    {
        $page = new FloorplanCreatePage($_POST);

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

            $url = \Config::OPTIONS['baseURI'] . 'facilities/floorplans/';

            if(isset($response['id']))
                header('Location: ' . $url . $response['id'] . '?SUCCESS=Floorplan Created');
            else
                header('Location: ' . $url . '?ERROR=Could not create floorplan');
        }

        return $page;
    }

    /**
     * @param int $id
     */
    private function getFloorplanPhoto(int $id)
    {
        $link = curl_init(\Config::OPTIONS['icURL'] . 'floorplans/' . $id. '/image');

        // Add API secret
        $headers = array(
            'Secret: ' . \Config::OPTIONS['icSecret']
        );

        // Add the user's token if it has been defined
        if(isset($_COOKIE[\Config::OPTIONS['cookieName']]))
            $headers[] = 'Token: ' . $_COOKIE[\Config::OPTIONS['cookieName']];

        curl_setopt($link, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($link, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($link, CURLOPT_CUSTOMREQUEST, "GET");

        $response = curl_exec($link);
        $type = curl_getinfo($link, CURLINFO_CONTENT_TYPE);
        curl_close($link);

        header('Content-type: ' . $type);
        echo $response;
        exit;
    }

    /**
     * @param int $id
     * @return FloorplanPage
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    private function updateFloorplanImage(int $id)
    {
        $page = new FloorplanPage($id);

        if(!isset($_FILES['floorplanImage']) OR $_FILES['floorplanImage']['size'] === 0)
        {
            $page->setErrors(['Floorplan image required']);
            return $page;
        }

        // Add API secret
        $headers = array(
            'Secret: ' . \Config::OPTIONS['icSecret']
        );

        // Add the user's token if it has been defined
        if(isset($_COOKIE[\Config::OPTIONS['cookieName']]))
            $headers[] = 'Token: ' . $_COOKIE[\Config::OPTIONS['cookieName']];


        $link = curl_init(\Config::OPTIONS['icURL'] . 'floorplans/' . $id . '/image');
        curl_setopt($link, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($link, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($link, CURLOPT_POST, true);
        curl_setopt(
            $link,
            CURLOPT_POSTFIELDS,
            array(
                'floorplanImage' => curl_file_create($_FILES['floorplanImage']['tmp_name'], $_FILES['floorplanImage']['type'], basename($_FILES['floorplanImage']['name']))
            )
        );

        curl_exec($link);
        $responseCode = curl_getinfo($link, CURLINFO_HTTP_CODE);

        curl_close($link);

        if($responseCode === HTTPResponse::NO_CONTENT)
        {
            $page->setSuccess(['Floorplan image updated']);
        }
        else
        {
            $page->setErrors(['Floorplan image could not be updated']);
        }

        return $page;
    }
}
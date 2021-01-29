<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 11/01/2019
 * Time: 3:40 PM
 */


namespace extensions\netuserman\controllers;


use controllers\Controller;
use extensions\netuserman\views\pages\CreateGroupPage;
use extensions\netuserman\views\pages\CreateUserPage;
use extensions\netuserman\views\pages\EditGroupPage;
use extensions\netuserman\views\pages\EditUserPage;
use extensions\netuserman\views\pages\NetUserManHomePage;
use extensions\netuserman\views\pages\SearchGroupPage;
use extensions\netuserman\views\pages\SearchUserPage;
use extensions\netuserman\views\pages\ViewGroupPage;
use extensions\netuserman\views\pages\ViewUserPage;
use models\HTTPResponse;
use views\View;

class NetUserManController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\EntryNotFoundException
     */
    public function getPage(): ?View
    {
        $route = $this->request->next();
        $guid = $this->request->next();

        if($route === NULL)
            return new NetUserManHomePage();
        else if($route === 'view')
        {
            if(!empty($_FILES))
                $this->uploadThumbnailPhoto($guid);
            return new ViewUserPage((string)$guid);
        }
        else if($route === 'viewgroup')
            return new ViewGroupPage((string)$guid);
        else if($route === 'photo')
            $this->getUserPhoto((string)$guid);
        else if($route === 'edit')
            return new EditUserPage((string)$guid);
        else if($route === 'editgroup')
            return new EditGroupPage((string)$guid);
        else if($route === 'search')
            return new SearchUserPage();
        else if($route === 'searchgroups')
            return new SearchGroupPage();
        else if($route === 'create')
            return new CreateUserPage();
        else if($route === 'creategroup')
            return new CreateGroupPage();

        return NULL;
    }

    /**
     * @param string $guid
     */
    private function getUserPhoto(string $guid): void
    {
        $link = curl_init(\Config::OPTIONS['icURL'] . 'netuserman/' . $guid . '/photo');

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
        curl_close($link);

        header('Content-type: image/jpeg');
        echo $response;
        exit;
    }

    /**
     * @param string $guid
     */
    private function uploadThumbnailPhoto(string $guid)
    {
        // Add API secret
        $headers = array(
            'Secret: ' . \Config::OPTIONS['icSecret']
        );

        // Add the user's token if it has been defined
        if(isset($_COOKIE[\Config::OPTIONS['cookieName']]))
            $headers[] = 'Token: ' . $_COOKIE[\Config::OPTIONS['cookieName']];


        $link = curl_init(\Config::OPTIONS['icURL'] . 'netuserman/' . $guid . '/photo');
        curl_setopt($link, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($link, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($link, CURLOPT_POST, true);
        curl_setopt(
            $link,
            CURLOPT_POSTFIELDS,
            array(
                'thumbnailphoto' => curl_file_create($_FILES['thumbnailphoto']['tmp_name'], $_FILES['thumbnailphoto']['type'], basename($_FILES['thumbnailphoto']['name']))
            )
        );

        curl_exec($link);
        $responseCode = curl_getinfo($link, CURLINFO_HTTP_CODE);

        curl_close($link);

        $currPage = \Config::OPTIONS['baseURI'] . 'netuserman/view/' . $guid;

        if($responseCode === HTTPResponse::NO_CONTENT)
            header('Location: ' . $currPage . '?SUCCESS=Photo updated');
        else
        {
            header('Location: ' . $currPage . '?ERROR=Photo could not be updated');
        }
    }
}

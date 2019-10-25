<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 10/25/2019
 * Time: 9:53 AM
 */


namespace controllers\chat;


use controllers\Controller;
use views\pages\chat\ChatClientPage;
use views\View;

class ChatController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function getPage(): ?View
    {
        return new ChatClientPage();
    }
}
<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 4/08/2019
 * Time: 4:44 PM
 */


namespace views\pages;

use exceptions\EntryNotFoundException;

class InboxViewPage extends ModelPage
{
    /**
     * InboxViewPage constructor.
     * @param string|null $notificationId
     * @throws EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $notificationId)
    {
        parent::__construct("currentUser/notifications/$notificationId");

        $this->setVariable("tabTitle", "View Notification");
        $this->setVariable("content", self::templateFileContents("InboxNotification", self::TEMPLATE_PAGE));

        $notification = $this->response->getBody();

        $this->setVariable('id', $notification['id']);
        $this->setVariable('title', htmlentities($notification['title']));
        $this->setVariable('date', $notification['time']);
        $this->setVariable('message', htmlentities($notification['data']));
    }
}
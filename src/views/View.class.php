<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury Merlot
 *
 * User: lromero
 * Date: 3/22/2019
 * Time: 6:06 PM
 */


namespace views;


use exceptions\ViewException;

abstract class View
{
    const TEMPLATE_PAGE = 'pages';
    const TEMPLATE_CONTENT = 'content';
    const TEMPLATE_ELEMENT = 'elements';
    const TEMPLATE_FORM = 'forms';

    protected $template;

    /**
     * @param string $htmlDocumentName The name of the html source document (without .html)
     * @param string $type The directory the document is stored in (e.g., content, elements, pages)
     * @return string
     * @throws ViewException
     */
    public static function templateFileContents(string $htmlDocumentName, string $type): string
    {
        $file = dirname(__FILE__) . "/../html/$type/$htmlDocumentName.html";
        if (!is_file($file))
        {
            throw new ViewException(ViewException::MESSAGES[ViewException::TEMPLATE_NOT_FOUND] . ": $htmlDocumentName", ViewException::TEMPLATE_NOT_FOUND);
        }
        return file_get_contents($file);
    }

    /**
     * @return string
     * @throws ViewException
     */
    public function render(): string
    {
        if(isset($_GET['NOTICE']))
            $this->setNotices(array($_GET['NOTICE']));

        $this->setVariable("baseURI", \Config::OPTIONS['baseURI']);
        $this->setVariable("appName", \Config::OPTIONS['appName']);
        return preg_replace("/\{\{@(.*)\}\}/", null, $this->template);
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $variableName
     * @param $value
     */
    public function setVariable(string $variableName, $value)
    {
        $this->template = str_replace("{{@$variableName}}", $value, $this->template);
    }

    /**
     * Bulk sets variables using an associative array
     * @param array $variables
     */
    public function setVariables(array $variables)
    {
        foreach(array_keys($variables) as $variableName)
        {
            // Skip arrays
            if(is_array($variables[$variableName]))
                continue;

            $this->setVariable($variableName, htmlentities($variables[$variableName]));
        }
    }

    /**
     * @param string $template
     */
    protected function setTemplate(string $template)
    {
        $this->template = $template;
    }

    /**
     * @param string $htmlDocumentName
     * @param $type
     * @throws ViewException
     */
    protected function setTemplateFromHTML(string $htmlDocumentName, $type)
    {
        $this->template = self::templateFileContents($htmlDocumentName, $type);
    }

    /**
     * Display error message dialog
     *
     * @param array $errors
     * @throws \exceptions\ViewException
     */
    public function setErrors(array $errors)
    {
        $this->setNotifications($errors, 'error', 'Error');
    }

    /**
     * @param array $notices
     * @throws \exceptions\ViewException
     */
    public function setNotices(array $notices)
    {
        $this->setNotifications($notices, 'notice', 'Notice');
    }

    /**
     * @param array $attributes
     * @param string|null $default
     * @return string
     */
    public static function generateAttributeOptions(array $attributes, ?string $default = NULL): string
    {
        $select = "<option value=''>--SELECT--</option>";

        foreach($attributes as $attribute)
        {
            if($default !== NULL AND $attribute['code'] == $default)
                $selected = 'selected';
            else
                $selected = '';

            $select .= "<option value='{$attribute['code']}' $selected>{$attribute['name']}</option>\n";
        }

        return $select;
    }

    /**
     * @param array $notifications
     * @param string $type
     * @param string $title
     * @throws \exceptions\ViewException
     */
    protected function setNotifications(array $notifications, string $type, string $title)
    {
        $notificationString = "<ul>";

        foreach($notifications as $notification)
        {
            $notificationString .= "<li>$notification</li>";
        }

        $notificationString .= "</ul>";

        $this->setVariable("notifications", View::templateFileContents("Notifications", self::TEMPLATE_ELEMENT));
        $this->setVariable("notificationClass", "notifications-$type");
        $this->setVariable("notificationTitle", $title);
        $this->setVariable("notifications", $notificationString);

        if($type == 'error')
            $this->setVariable('icon', 'error');
        else
            $this->setVariable('icon', 'about');
    }
}
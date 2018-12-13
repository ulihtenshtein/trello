<?php
//Загрузка конфигурации и общих функций
class Utils
{

    static public function getGlobal($value, $subArr = "this")
    {
        if ($subArr !== "") {
            return $GLOBALS[$subArr][$value];
        } else {
            return $GLOBALS[$value];
        }
    }

    static public function setGlobal($key, $value)
    {
        $GLOBALS['this'][$key] = $value;
    }

    static public function dirRoot()
    {
        return self::getGlobal('dir_root');
    }

    static public function baseUrl()
    {
        return self::getGlobal('base_url');
    }

    static public function siteUrl()
    {
        return self::getGlobal('site_url');
    }

    public static function redirect($path = "")
    {
        if (substr($path, 0, 5) !== "http:") {
            header("Location: " . Utils::baseUrl() . "/" . $path);
        } else {
            header("Location: " . $path);
        }
    }
}


Utils::setGlobal('dir_root', $_SERVER['DOCUMENT_ROOT']);
Utils::setGlobal('base_url', "http://" . $_SERVER['HTTP_HOST']);
Utils::setGlobal('site_url', $_SERVER['HTTP_HOST']);
Utils::setGlobal('site_url_short', str_replace("http://", "", str_replace("www.", "", $GLOBALS['this']['site_url'])));

//Подключение библиотек
class Document
{

    protected static $_instance;
    protected $title;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function render($viewName, $data = array())
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }
        }

        include(Utils::dirRoot() . "/app/view/{$viewName}.php");
    }

    public function setTitle($documentTitle)
    {
        $this->title = $documentTitle;
    }

    public function getTitle()
    {
        return $this->title;
    }
}

include(Utils::dirRoot() . "/app/Controller.php");
include(Utils::dirRoot() . "/app/TrelloRequest.php");

//Обработка ошибок
error_reporting(E_ALL);

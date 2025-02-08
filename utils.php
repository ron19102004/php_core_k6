<?php
session_start();
define("ENV_PATH", $_SERVER['DOCUMENT_ROOT'] . "/env.json");
define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . "/src");
define("PHONE_REGEX", "/^(0|\+84)[3-9][0-9]{8,9}$/");
define("EMAIL_REGEX", "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/");

class Import
{
    public static function urlActive($url)
    {
        if ($_SERVER['REQUEST_URI'] == $url) return true;
        return false;
    }
    public static function config(array $names)
    {
        foreach ($names as $name) {
            require(ROOT_PATH  . "/configs/" . $name . ".config.php");
        }
    }
    public static function controller(array $names)
    {
        foreach ($names as $name) {
            require(ROOT_PATH  . "/controllers/" . $name . ".controller.php");
        }
    }
    public static function model(array $names)
    {
        foreach ($names as $name) {
            require(ROOT_PATH  . "/models/" . $name . ".model.php");
        }
    }
    public static function service(array $names)
    {
        foreach ($names as $name) {
            require(ROOT_PATH  . "/services/" . $name . ".service.php");
        }
    }
    public static function repository(array $names)
    {
        foreach ($names as $name) {
            require(ROOT_PATH  . "/repositories/" . $name . ".repository.php");
        }
    }
}
class FormHelper
{
    public static function get_input(string $key)
    {
        $value =  null;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST[$key])) {
                $value =  filter_input(INPUT_POST, htmlspecialchars($key));
            }
        } else {
            if (isset($_GET[$key])) {
                $value =  filter_input(INPUT_GET, htmlspecialchars($key));
            }
        }
        if (is_null($value)) throw new Exception('Key not found');
        return $value;
    }
}
class URLHelper
{
    public static function redirect(string $url)
    {
        header('Location: ' . $url);
    }
    public static function my_url()
    {
        return $_SERVER['REQUEST_URI'];
    }
}
class EnvHelper
{
    public static function get(string $key)
    {
        $jsonData = file_get_contents(ENV_PATH);
        $data = json_decode($jsonData, true);
        return $data[$key];
    }
}
class SessionHelper
{
    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function get(string $key)
    {
        return $_SESSION[$key];
    }
    public static function remove(string $key)
    {
        unset($_SESSION[$key]);
    }
    public static function destroy()
    {
        session_destroy();
    }
}
class RegexHelper
{
    public static  function is_phone($phone)
    {
        return preg_match(PHONE_REGEX, $phone);
    }

    public static function is_email($email)
    {
        return preg_match(EMAIL_REGEX, $email);
    }
}

// require($_SERVER['DOCUMENT_ROOT'] . "/utils.php");
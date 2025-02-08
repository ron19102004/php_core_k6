<?php
class Database
{
    private static $instance = null;
    private function __construct() {}
    public static function get_instance()
    {
        if (self::$instance == null) {
            $db_properties = EnvHelper::get("db");

            $servername = $db_properties["host"];
            $username = $db_properties["user"];
            $password = $db_properties["password"];
            $port = $db_properties["port"];
            $dbname = $db_properties["database"];

            try {
                self::$instance = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
                // set the PDO error mode to exception
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$instance;
    }
    public static function close(){
        self::$instance = null;
    }
}

<?php
require_once 'config.php';

class DATABASE
{
    private static $_instance;
    private $username;
    private $password;
    private $host;
    private $database;

    public function __construct()
    {
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->host = HOST;
        $this->database = DATABASE;
    }
    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a database singleton.");
    }

    public static function getInstance():Database{
        if (!isset(self::$_instance)){
            self::$_instance = new Database();
        }
        return self::$_instance;
    }
    public function connect()
    {
        try{
            $conn = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode" => "prefer"]
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        }catch(PDOException $e){
            die("Connection failed: ".$e->getMessage());
        }
    }
}
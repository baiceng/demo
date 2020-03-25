<?php

include_once('config.php');

class db extends mysqli
{
    private static $instance = null;

    private $dbHost = DBHOST;
    private $dbUser = DBUSER;
    private $dbPwd = DBPWD;
    private $dbName = DBNAME;

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    public function __construct()
    {
        parent::__construct($this->dbHost, $this->dbUser, $this->dbPwd, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    public function get_result($query)
    {
        $result = $this->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function insert_result($query)
    {
        try {
            return $this->query($query);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

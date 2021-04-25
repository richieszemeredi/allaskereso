<?php

class Database
{

    private static $instance;
    private $connection;
    private $hostname;
    private $port;
    private $sid;
    private $username;
    private $password;
    private $tns;
    private $character_set = "UTF8";
    private $initTables = false;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */

    public function __clone() {
        throw new Exception("Can't clone a singleton");
    }

    private function __construct()
    {
        $ini = parse_ini_file("resources/db.ini");
        $this->hostname = $ini['hostname'];
        $this->port = $ini['port'];
        $this->username = $ini['username'];
        $this->password = $ini['password'];
        $this->sid = $ini['SID'];
        $this->initTables = $ini['init_tables'];
        $this->setTNS($this->hostname, $this->port, $this->sid);
        $this->connectToDatabase();
        if ($this->initTables) {
            $this->initTables();
        }
    }

    private function initTables() {
        $conn = $this->getConnection();
        $sql_arr = explode(";", file_get_contents('resources/init.sql'));
        foreach ($sql_arr as $sql) {
            $stid = oci_parse($conn, $sql);
            oci_execute($stid, OCI_NO_AUTO_COMMIT);
        }
    }

    private function connectToDatabase() {
        $this->connection = oci_connect($this->username, $this->password, $this->tns, $this->character_set);
        if (!$this->isConnected()) {
            echo(oci_error());
        }
    }

    public function getConnection() {
        if (!$this->isConnected()) {
            $this->connectToDatabase();
        }
        return $this->connection;
    }

    private function isConnected() {
        return !$this->connection;
    }

    private function setTNS($hostname, $port, $sid) {
        $this->tns = "(DESCRIPTION =
                        (ADDRESS_LIST =
                          (ADDRESS = (PROTOCOL = TCP)(HOST = $hostname)(PORT = $port))
                        )
                        (CONNECT_DATA =
                          (SID = $sid)
                        )
                      )";
    }
}
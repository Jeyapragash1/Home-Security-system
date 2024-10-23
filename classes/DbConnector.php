<?php

class DbConnector {

    private $hostname = "localhost";
    private $dbname = "home-security-system";
    private $dbuser = "root";
    private $dbpwd = "";

    public function getConnection() {
        $dsn = "mysql:host=" . $this->hostname . ";dbname=" . $this->dbname;

        try {
            $con = new PDO($dsn, $this->dbuser, $this->dbpwd);
            return $con;
        } catch (PDOException $ex) {
            die("Connection Error!" . $ex->getMessage());
        }
    }

}
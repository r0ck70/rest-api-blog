<?php

class Database {
    // Properties
    private $host   =   'localhost';
    private $user   =   'root';
    private $pass   =   '';
    private $dbName =   'myblog';
    private $connect;

    // DB Connection
    public function connect() {
        $this->connect = null;

        try {
            $this->connect = new PDO('mysql:host='.$this->host.'; dbname='.$this->dbName, $this->user, $this->pass);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }

        return $this->connect;
    }

}
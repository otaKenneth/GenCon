<?php

class Database {

    private $host = 'localhost';
    private $dbname = 'gencon';
    private $uname = 'root';
    private $pword = '';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn =  new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->uname, $this->pword);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}

?>
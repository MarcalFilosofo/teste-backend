<?php

class Conn 
{
    private $host = "127.0.0.1";
    private $database = "teste_backend";
    private $username = "root";
    private $password = "";

    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ALL);

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

    }
}

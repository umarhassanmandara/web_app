<?php


class Connect
{
    private $host = "localhost";
    private $db_name = "php";
    private $password = "";
    private $name = "root";
    
    protected function conn()
    {

        $connection = new mysqli($this->host, $this->name, $this->password, $this->db_name);

        if ($connection->connect_error) {
            die("connection failed: " . $connection->connect_error);
        }
        return $connection;
    }
}

//  $conn = new Connect();
//  var_dump($conn->conn());

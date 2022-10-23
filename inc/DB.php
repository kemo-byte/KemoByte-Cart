<?php
class DB
{
    private $driver;
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $tname;
    private $conn;
    public function __construct(
        $driver = "mysql",
        $host = "localhost",
        $user = "root",
        $pass = "kemobyte",
        $dbname = "shopping",
        $tname = "products"
    ) {
        $this->driver = $driver;
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
        $this->tname = $tname;

        try {
            // $this->conn = new PDO("mysql:host=localhost;dbname=shopping", 'root', 'kemobyte');
            $this->conn = new PDO($this->driver . ":host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->pass);

            // create the database
            $query = 'CREATE DATABASE IF NOT EXISTS ' . $this->dbname . ';';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            // echo $stmt ?
            //     $this->dbname . " created !" : "failed";
            //create the table
            $query = 'CREATE TABLE IF NOT EXISTS ' . $this->tname . ' (
                id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                product_name VARCHAR(255) NOT NULL,
                product_price FLOAT,
                product_img VARCHAR(255)
            );';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            // echo $stmt ?
            //     $this->tname . " created !" : "failed";
        } catch (\PDOException $th) {
            echo 'failed : ' . $th;
            // include ('error.php');
        }
    }
    public function getData()
    {
        $query = "SELECT * FROM " . $this->tname;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

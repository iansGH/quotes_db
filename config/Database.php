<?php
class Database{

    //DB Params
    private $conn;
    private $host;
    private $port;
    private $dbname;
    private $username;
    private $password;

    public function __construct(){
        $this->username = getenv('USERNAME');
        $this->password = getenv('PASSWORD');
        $this->dbname = getenv('DBNAME');
        $this->host = getenv('HOST');
        $this->port = getenv('PORT');
    }

    //DB Connect
    public function connect(){
        //instead of $this-conn = null; 
        if($this->conn){
            //connection already exists, return it
            return $this->conn;
        } else{

            //$dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";
            $dsn = "pgsql:host={$this->host};dbname={$this->dbname}";

            try{
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }
        }
    }

    /*PHP Database Connection Class for PostgreSQL from Week 6
    private $host = 'localhost';
    private $port = '5432';
    private $db_name = 'quotes';
    private $username = 'postgres';
    private $password = 'postgres';
    private $conn;

    public function connect() {
        $this->conn = null;
        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            //echo for tutorial, but log the error for production
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }*/
}

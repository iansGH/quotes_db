<?php
class Quote{
    //DB stuff
    private $conn;
    private $table = 'quotes';

    //Quotes Properties
    public $id;
    public $quote;
    public $author_id;
    public $category_id;

    //Constructor with DB

    public function __construct($db) {
        $this->conn = $db;
    }

    //Get Quotes
    public function read(){
        //Create query
        if(isset($_GET['author_id']) && isset($_GET['category_id'])){
            $query = 'SELECT 
                            id,
                            quote,
                            author_id,
                            category_id
                        FROM
                        ' . $this->table . ' 
                        WHERE
                            author_id = ? 
                        AND
                            category_id = ? 
                        ORDER BY
                            id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //bind author_id and category_id
            $stmt -> bindParam(1, $this->author_id);
            $stmt -> bindParam(2, $this->category_id);
        }
        
        /*Code block below is not needed because read_single
        is used instead but I like it
        $quote->id = isset($_GET['id']) ? $_GET['id'] : die();
        else if(isset($_GET['id'])){
            $query = 'SELECT 
                            id,
                            quote,
                            author_id,
                            category_id
                        FROM
                        ' . $this->table . ' 
                        WHERE
                            id = ?
                        ORDER BY
                            id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //bind id
            $stmt -> bindParam(1, $this->id);
        }*/

        //$quote->author_id = isset($_GET['author_id']) ? $_GET['author_id'] : die();
        else if(isset($_GET['author_id'])){
            $query = 'SELECT 
                            id,
                            quote,
                            author_id,
                            category_id
                        FROM
                        ' . $this->table . ' 
                        WHERE
                            author_id = ?
                        ORDER BY
                            id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //bind id
            $stmt -> bindParam(1, $this->author_id);
        }
        //$quote->category_id = isset($_GET['category_id']) ? $_GET['category_id'] : die();
        else if (isset($_GET['category_id'])){
            $query = 'SELECT 
                            id,
                            quote,
                            author_id,
                            category_id
                        FROM
                        ' . $this->table . ' 
                        WHERE
                            category_id = ?
                        ORDER BY
                            id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //bind id
            $stmt -> bindParam(1, $this->category_id);
        }
        else{
            $query = 'SELECT 
                            *
                        FROM
                        ' . $this->table . ' 
                        ORDER BY
                            id';
            
            //prepare statement
            $stmt = $this->conn->prepare($query);
        }

        //execute
        $stmt->execute();

        return $stmt;
    }

    //Get single Quotes
    public function read_single(){

        //Create query   
        $query = 'SELECT 
            id,
            quote,
            author_id,
            category_id
        FROM
            ' . $this->table . ' 
        WHERE
            id = ?';

        //prepare statement 
        $stmt = $this->conn->prepare($query);

        //bind id
        $stmt -> bindParam(1, $this->id);

        //execute
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties
        if(isset($row['quote'])){
            $this->quote = $row['quote'];
            $this->author_id = $row['author_id'];
            $this->category_id = $row['category_id'];
            return true;
        }
        else{
            return false;
        }
    }

    
    //create Quotes
    public function create(){
        //create query
        $query = 'INSERT INTO ' . $this->table . ' (
                quote, 
                author_id, 
                category_id
                ) VALUES (
                    :quote,
                    :author,
                    :category)';
        
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data 
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author', $this->author_id);
        $stmt->bindParam(':category', $this->category_id);

        //execute query
        if($stmt->execute()){
            return true;
        }

        //print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);

        return false; 
    }

     //update Quotes
     public function update(){
        //create query
        $query = 'UPDATE ' . $this->table . '
            SET
                quote = :quote,
                author_id = :author,
                category_id = :category
            WHERE
                id = :id';
        
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data 
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author', $this->author_id);
        $stmt->bindParam(':category', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        //execute query
        if($stmt->execute()){
            return true;
        }

        //print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);

        return false; 
    }

    //delete Quotes
    public function delete(){
        //create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':id', $this->id);

        //execute query
        if($stmt->execute()){
            return true;
        }

        //print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);

        return false; 
    }

}
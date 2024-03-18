<?php
class Author{
    //DB stuff
    private $conn;
    private $table = 'authors';

    //properties
    public $id;
    public $author;

    //Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //get authors
    public function read(){
        //create query
        $query = 'SELECT
            id, 
            author
        FROM
            ' . $this->table . '
        ORDER BY
            id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //excute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single author
    public function read_single(){
        // Create query
        $query = 'SELECT
            id,
            author
        FROM
        ' . $this->table . '
        WHERE 
            id = ?';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        if(isset($row['author'])){
            $this->id = $row['id'];
            $this->author = $row['author'];
            return true;
        }
        else{
            return false;
        }
    }

    // Create author
    public function create() {
        // Create Query
        $query = 'INSERT INTO ' . $this->table . ' (
            author 
            ) VALUES (
                :author)';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));

        // Bind data
        $stmt-> bindParam(':author', $this->author);

        // Execute query
        if($stmt->execute()) {
        return true;
        }

        // Print error if something goes wrong
        printf('Error: $s.\n', $stmt->error);

        return false;
    }

    // Update author
    public function update() {
        // Create Query
        $query = 'UPDATE ' .
            $this->table . '
        SET
            author = :author
            WHERE
            id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt-> bindParam(':author', $this->author);
        $stmt-> bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
        return true;
        }

        // Print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);

        return false;
    }

    // Delete author
    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind Data
        $stmt-> bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);

        return false;
    }
}
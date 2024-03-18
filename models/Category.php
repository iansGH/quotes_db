<?php
class Category{
    //DB stuff
    private $conn;
    private $table = 'categories';

    //properties
    public $id;
    public $category;

    //Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //get categories
    public function read(){
        //create query
        $query = 'SELECT
            id, 
            category
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

    // Get Single Category
    public function read_single(){
        // Create query
        $query = 'SELECT
            id,
            category
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
        if(isset($row['category'])){
            $this->id = $row['id'];
            $this->category = $row['category'];
            return true;
        }
        else{
            return false;
        }
    }

    // Create Category
    public function create() {
        // Create Query
        $query = 'INSERT INTO ' . $this->table . ' (
            category 
            ) VALUES (
                :category)';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));

        // Bind data
        $stmt-> bindParam(':category', $this->category);

        // Execute query
        if($stmt->execute()) {
        return true;
        }

        // Print error if something goes wrong
        printf('Error: $s.\n', $stmt->error);

        return false;
    }

    // Update Category
    public function update() {
        // Create Query
        $query = 'UPDATE ' .
            $this->table . '
        SET
            category = :category
            WHERE
            id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt-> bindParam(':category', $this->category);
        $stmt-> bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
        return true;
        }

        // Print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);

        return false;
    }

    // Delete Category
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
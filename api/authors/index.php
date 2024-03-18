<?php

/* Abridged message from Dave Gray
...Also a good place to get your JSON data decoded.
Do things once in this file so you don't have to repeat 
the same thing multiple times in the methods 
(read, read_single, etc) 
*/

    //set the required headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //handle OPTIONS requests for CORS
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    //require the other needed files - sometimes conditionally. 
    include_once '../../config/Database.php';
    include_once '../../models/Author.php';
    include_once '../../functions/isValid.php';
    
    //instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate quote object
    $author = new Author($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

      //Route to the various methods based on the HTTP method used
    //print_r($_GET);
    if ($method == "POST"){
        if(isset($data->author)){
                require_once('create.php');
            }
        else{
            echo json_encode(array('message' => 'Missing Required Parameters'));
        }
    }
    else if ($method == 'GET') {
        if (isset($_GET['id'])){
            require_once('read_single.php');
            exit();
        }
        else{
            require_once('read.php');
            exit();
        }
    }
    else if ($method == "PUT"){
        //check if id, author exist
        if(isset($data->id) && isset($data->author)){
            //check if id and author are valid
            if(isValid($author, $data->id)) {
                require_once('update.php');
            }
            else{
                echo json_encode(array('message'=> 'author_id Not Found'));
            }
        }
        else{
            echo json_encode(array('message' => 'Missing Required Parameters'));
        }
    }
    else if ($method == "DELETE"){
        //check if id, author exist
        if(isset($data->id)){
            //check if id and author are valid
            if(isValid($author, $data->id)) {
                require_once('delete.php');
            }
            else{
                echo json_encode(array('message'=> 'No Author Found'));
            }
        }
        else{
            echo json_encode(array('message' => 'Missing Required Parameters'));
        }
    }

?>
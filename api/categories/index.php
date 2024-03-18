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
    include_once '../../models/Category.php';
    include_once '../../functions/isValid.php';
    
    //instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate quote object
    $category = new Category($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

      //Route to the various methods based on the HTTP method used
    //print_r($_GET);
    if ($method == "POST"){
        if(isset($data->category)){
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
        //check if id, category exist
        if(isset($data->id) && isset($data->category)){
            //check if id and category are valid
            if(isValid($category, $data->id)) {
                require_once('update.php');
            }
            else{
                echo json_encode(array('message'=> 'category_id Not Found'));
            }
        }
        else{
            echo json_encode(array('message' => 'Missing Required Parameters'));
        }
    }
    else if ($method == "DELETE"){
        //check if id, category exist
        if(isset($data->id)){
            //check if id and category are valid
            if(isValid($category, $data->id)) {
                require_once('delete.php');
            }
            else{
                echo json_encode(array('message'=> 'No Category Found'));
            }
        }
        else{
            echo json_encode(array('message' => 'Missing Required Parameters'));
        }
    }

?>
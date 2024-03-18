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
    include_once '../../models/Quote.php';
    include_once '../../models/Author.php';
    include_once '../../models/Category.php';
    include_once '../../functions/isValid.php';
    
    //instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate quote object
    $quote = new Quote($db);
    $author = new Author($db);
    $category = new Category($db);

    //get raw quoted data
    $data = json_decode(file_get_contents('php://input'));
    //echo var_dump($data);

    /*check if the required parameters were submitted 
    with the request. No database queries are required 
    if the parameter requirements are not met. */


    /*Next - if needed, check if the author_id or category_id 
    (or both) exist. This is where I use the isValid function 
    that was discussed in this thread. Search for that if needed.*/

    //Route to the various methods based on the HTTP method used
    //if(isValid($quote, $_GET['id'])){}
    //if (isset($_GET['id'])){}
    //print_r($_GET);
    
    if ($method == "POST"){
        if(isset($data->quote) && isset($data->author_id) && isset($data->category_id)){
            //check if author and category are valid
            if(isValid($quote, $data->author_id) && isValid($quote, $data->category_id)){
                require_once('create.php');
            }
            else if(!isValid($quote, $data->author_id)){
                echo json_encode(array('message'=> 'author_id Not Found'));
            }
            else{ // isValid($quote, $data->category_id) is false
                echo json_encode(array('message' => 'category_id Not Found'));
            }
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
        //check if id, quote, author_id and category_id exist
        if(isset($data->id) && isset($data->quote) && isset($data->author_id) && isset($data->category_id)){
            //check if id, author_id and category_id are valid
            if(isValid($quote, $data->id) && isValid($author, $data->author_id) && isValid($category, $data->category_id)){
                require_once('update.php');
            }else if(!isValid($quote, $data->id)){
                echo json_encode(array('message'=> 'No Quotes Found'));
            }
            else if(!isValid($author, $data->author_id)){
                echo json_encode(array('message'=> 'author_id Not Found'));
            }
            elseif(!isValid($category, $data->category_id)){
                echo json_encode(array('message' => 'category_id Not Found'));
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
            if(isValid($quote, $data->id)) {
                require_once('delete.php');
            }
            else{
                echo json_encode(array('message'=> 'No Quotes Found'));
            }
        }
        else{
            echo json_encode(array('message' => 'Missing Required Parameters'));
        }
    }


?>
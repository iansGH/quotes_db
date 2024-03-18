<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//get id
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

//get author
$author->read_single();

//create array
if(isset($author->author)){
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author,
    );

    //make json
    print_r(json_encode($author_arr));
}
else{
    //no single author
    echo json_encode(
        array('message'=> 'author_id Not Found')
    );
} 

  //GET
  //http://localhost/php_rest_authorsdbmysql/api/authors/read_single.php?id=2
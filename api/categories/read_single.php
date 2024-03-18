<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//get id
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

//get category
$category->read_single();

//create array
if(isset($category->category)){
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category,
    );

    //make json
    print_r(json_encode($category_arr));
}
else{
    //no single category
    echo json_encode(
        array('message'=> 'category_id Not Found')
    );
} 

  //GET
  //http://localhost/php_rest_quotesdbmysql/api/categories/read_single.php?id=2
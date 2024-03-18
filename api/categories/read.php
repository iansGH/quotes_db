<?php

//$quote->id = isset($_GET['id']) ? $_GET['id'] : die();
if(isset($_GET['id'])){
    $quote->id = $_GET['id'];
}
//$quote->category_id = isset($_GET['category_id']) ? $_GET['category_id'] : die();
if(isset($_GET['category_id'])){
    $quote->category_id = $_GET['category_id'];
}

//category query
$result = $category->read();

//get row count
$num = $result->rowCount();

//check if any categories
if($num>0){
    //Category array 
    $cat_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $cat_item = array(
            'id' => $id,
            'category' => $category
        );

        //push to 'data'
        array_push($cat_arr, $cat_item);
    }
    
    //turn to json
    echo json_encode($cat_arr);

}else{
    //no categories
    echo json_encode(
        array('message' => 'No Categories Found')
    );

}

//GET
//http://localhost/php_rest_quotesdbmysql/api/categories/read.php
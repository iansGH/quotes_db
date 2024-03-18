<?php

//$quote->id = isset($_GET['id']) ? $_GET['id'] : die();
if(isset($_GET['id'])){
    $quote->id = $_GET['id'];
}
//$quote->author_id = isset($_GET['author_id']) ? $_GET['author_id'] : die();
if(isset($_GET['author_id'])){
    $quote->author_id = $_GET['author_id'];
}

//author query
$result = $author->read();

//get row count
$num = $result->rowCount();

//check if any authors
if($num>0){
    //author array 
    $author_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $author_item = array(
            'ID' => $id,
            'Author' => $author
        );

        //push to 'data'
        array_push($author_arr, $author_item);
    }
    
    //turn to json
    echo json_encode($author_arr);

}else{
    //no authors
    echo json_encode(
        array('message => "No Authors Found')
    );

}

//GET
//http://localhost/php_rest_quotesdbmysql/api/authors/read.php
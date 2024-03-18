<?php

//$quote->id = isset($_GET['id']) ? $_GET['id'] : die();
if(isset($_GET['id'])){
    $quote->id = $_GET['id'];
}
//$quote->author_id = isset($_GET['author_id']) ? $_GET['author_id'] : die();
if(isset($_GET['author_id'])){
    $quote->author_id = $_GET['author_id'];
}
//$quote->category_id = isset($_GET['category_id']) ? $_GET['category_id'] : die();
if(isset($_GET['category_id'])){
    $quote->category_id = $_GET['category_id'];
}
//echo var_dump($quote->author_id);

//quote query
$result = $quote->read();
//echo var_dump($result);

//get row count
$num = $result->rowCount();
//echo var_dump($num);

//check if any quotes 
if($num>0){
    //quote array 
    $quotes_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => html_entity_decode($quote),
            'author' => $author_id,
            'category' => $category_id
        );

        //push to 'data'
        array_push($quotes_arr, $quote_item);
    }
    
    //turn to json
    echo json_encode($quotes_arr);

}else{
    //no quotes
    echo json_encode(
        array("message:" => 'No Quotes Found')
    );

}

//GET
//http://localhost/php_rest_quotesdbmysql/api/quotes/read.php
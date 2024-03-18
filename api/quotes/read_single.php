<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//get id
$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

//get quote
$quote->read_single();

//create array
if(isset($quote->quote)){
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author_id,
        'category' => $quote->category_id
    );

    //make json
    print_r(json_encode($quote_arr));
}
else{
    //no single quote
    echo json_encode(array('message' => 'No Quotes Found'));
} 



//GET
//http://localhost/php_rest_quotesdbmysql/api/quotes/read_single.php?id=3
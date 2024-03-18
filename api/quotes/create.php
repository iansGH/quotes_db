<?php

$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

//create quote
if($quote->create()){
    $quote->id = $db->lastInsertId();
    
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author_id,
        'category' => $quote->category_id
    );

    //make json
    //print_r(json_encode($quote_arr));
    echo (json_encode($quote_arr));
    
}else{
    echo json_encode(
        array('message' => 'Quote Not Created')
    );
}

//POST
//http://localhost/php_rest_quotesdbmysql2/api/quotes/create.php
//Headers: Content-Type, application/json
/*Body, raw: {
    "quote": "This is a sample quote.",
    "author_id": 20,
    "category_id": 3
}*/
<?php
//set id to update
$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

//update quote
if($quote->update()){
    
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author_id,
        'category' => $quote->category_id
    );

    //make json
    print_r(json_encode($quote_arr));
}else{
    echo json_encode(
        array('message' => 'Quote Not Updated')
    );
}

//PUT
//http://localhost/php_rest_quotesdbmysql/api/quotes/update.php
//Headers: Content-Type, application/json
/*Body, raw: {     
    "quote": "This is an updated quote.",
    "author_id": 4,
    "category_id": 1,
    "id": "9"
}*/
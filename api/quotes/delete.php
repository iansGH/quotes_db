<?php
//set id to DELETE
$quote->id = $data->id;

//DELETE quote
if($quote->delete()){
    $quote_arr = array(
        //array('message' => 'Quote Deleted')
        'id' => $quote->id
    );
    print_r(json_encode($quote_arr));
}else{
    echo json_encode(
        array('message' => 'Quote Not Deleted')
    );
}

//DELETE
//http://localhost/php_rest_quotesdbmysql/api/quotes/delete.php
//Headers: Content-Type, application/json
//Body, raw: { "id": "1" }
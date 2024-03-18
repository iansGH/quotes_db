<?php

    $author->author = $data->author;

    // Create author
    if($author->create()) {
        $author->id = $db->lastInsertId();
    
        $author_arr = array(
            'id' => $author->id,
            'author' => $author->author,
        );

        //make json
        print_r(json_encode($author_arr));

    } else {
    echo json_encode(
        array('message' => 'Author Not Created')
    );
}

//POST
//http://localhost/php_rest_quotesdbmysql/api/authors/create.php
//Headers: Content-Type, application/json
//Body, raw: { "author": "First Author Created" }
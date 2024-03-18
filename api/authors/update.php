<?php
    // Set ID to UPDATE
    $author->id = $data->id;
    $author->author = $data->author;

    // Update Author
    if($author->update()) {

        $author_arr = array(
            'id' => $author->id,
            'author' => $author->author,
        );

        //make json
        //print_r(json_encode($author_arr));
        echo (json_encode(array($author_arr)));

    } else {
    echo json_encode(
        array('message' => 'Author not updated')
    );
    }

//PUT
//http://localhost/php_rest_quotesdbmysql/api/authors/update.php
//Headers: Content-Type, application/json
//Body, raw: { "author": "First Author Updated", "id": "5" }
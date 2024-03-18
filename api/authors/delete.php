<?php
    // Set ID to DELETE
    $author->id = $data->id;

    // Delete post
    if($author->delete()) {
        $author_arr = array(
            //array('message' => 'Author Deleted')
            'id' => $author->id
        );
        print_r(json_encode($author_arr));
    } else {
    echo json_encode(
        array('message' => 'Author not deleted')
    );
}

//DELETE
//http://localhost/php_rest_quotesdbmysql/api/authors/delete.php
//Headers: Content-Type, application/json
//Body, raw: { "id": "2" } //can only delete if not referenced by quotes table
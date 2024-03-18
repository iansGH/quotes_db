<?php
    // Set ID to DELETE
    $category->id = $data->id;

    // Delete post
    if($category->delete()) {
        $category_arr = array(
            //array('message' => 'Category Deleted')
            'id' => $category->id
        );
        print_r(json_encode($category_arr));
    } else {
    echo json_encode(
        array('message' => 'Category not deleted')
    );
}

//DELETE
//http://localhost/php_rest_quotesdbmysql/api/categories/delete.php
//Headers: Content-Type, application/json
//Body, raw: { "id": "6" } //can only delete if not referenced by quotes table
<?php

    $category->category = $data->category;

    // Create Category
    if($category->create()) {
        $category->id = $db->lastInsertId();
    
        $category_arr = array(
            'id' => $category->id,
            'category' => $category->category,
        );

        //make json
        print_r(json_encode($category_arr));

    } else {
    echo json_encode(
        array('message' => 'Category Not Created')
    );
}

//POST
//http://localhost/php_rest_quotesdbmysql/api/categories/create.php
//Headers: Content-Type, application/json
//Body, raw: { "category": "Fantasy" }
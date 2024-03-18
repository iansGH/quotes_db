<?php
    // Set ID to UPDATE
    $category->id = $data->id;
    $category->category = $data->category;

    // Update Category
    if($category->update()) {

        $category_arr = array(
            'id' => $category->id,
            'category' => $category->category,
        );

        //make json
        print_r(json_encode($category_arr));

    } else {
    echo json_encode(
        array('message' => 'Category not updated')
    );
    }

//PUT
//http://localhost/php_rest_quotesdbmysql2/api/categories/update.php
//Headers: Content-Type, application/json
//Body, raw: { "category": "Fantasy Sports", "id": "6" }
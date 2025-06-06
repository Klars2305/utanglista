<?php
/*
    Retrieving all product data from the database
    Handle all queries inside a try-catch block with
    a prepare syntax for another query (if needed).
    Use:
    ```
    
        mysqli_free_result(parameter: result);
        mysqli_next_result($connection); //Prepares next query

    ```

*/
require("../config/config.php");

// FETCH ALL PRODUCTS
try {
    $getAllProducts = "SELECT * FROM products WHERE is_deleted=0";
    $result = mysqli_query($connection, $getAllProducts);

    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    mysqli_next_result($connection); //Prepares next query
} catch (\Throwable $th) {
    throw $th;
}

//FETCH ALL PRODUCTS WITH THE JOIN TABLE OF CATEGORY
try {
    $fetchWithCategory = "SELECT products.id, prod_name, prod_price, category_name, prod_image
                        FROM products
                        INNER JOIN category
                        ON products.category_id = category.id
                        WHERE products.is_deleted=0;"
                    ;
    $result = mysqli_query($connection, $fetchWithCategory);
    $productsWithCategory = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    mysqli_next_result($connection); //Prepares next query
} catch (\Throwable $th) {
    throw $th;
}
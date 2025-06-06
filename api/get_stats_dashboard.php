<?php
/*
    Retrieving all statistical data from the database
    Handle all queries inside a try-catch block with
    a prepare syntax for another query (if needed).
    Use:
    ```
    
        mysqli_free_result(parameter: result);
        mysqli_next_result($connection); //Prepares next query

    ```

*/
require("../config/config.php");

//FETCH THE TOTAL COLLECTED PAYMENTS
try {
    $collectAmountQuery = "CALL getTotalCollectedPayments();"; //Stored Procedure
    $collectResult = mysqli_query($connection, $collectAmountQuery);
    $collectAmount = mysqli_fetch_assoc($collectResult);

    $totalCollectedAmount = $collectAmount["total_collected_amount"] ? $collectAmount["total_collected_amount"] : 0;
    mysqli_free_result($collectResult);
    mysqli_next_result($connection);
} catch (\Throwable $th) {
    throw $th;
}
// FETCH COUNT OF DATA
try {
    $customer_count = "CALL getCount()";
    $countResult = mysqli_query($connection, $customer_count) or die(mysqli_error($connection));
    $count = mysqli_fetch_assoc($countResult);

    $totalCount = $count['totalCount'] ? $count['totalCount'] : 0;

    mysqli_free_result($countResult);
    mysqli_next_result($connection); //Prepares next query
} catch (\Throwable $th) {
    echo $th;
}
//FETCH THE TOTAL COUNT OF HOW MANY PRODUCTS
try {
    $getProductCount = "CALL getProdCount()"; //Views
    $countResult = mysqli_query($connection, $getProductCount) or die(mysqli_error($connection));
    $prodCount = mysqli_fetch_assoc($countResult);

    $totalProdCount = $prodCount['totalInventory'] ? $prodCount['totalInventory'] : 0;
    mysqli_free_result($countResult);
    mysqli_next_result($connection); //Prepares next query

} catch (\Throwable $th) {
    throw $th;
}
//FETCH THE TOTAL UNCOLLECTED AMOUNT
try {
    $uncollectedQuery = "CALL getTotalUncollectedAmount();"; //Stored Procedure
    $uncollectedResult = mysqli_query($connection, $uncollectedQuery);
    $uncollectedAmount = mysqli_fetch_assoc($uncollectedResult);

    $totaluncollectedAmount = $uncollectedAmount["uncollectedAmount"] ? $uncollectedAmount["uncollectedAmount"] : 0;
    mysqli_free_result($uncollectedResult);
    mysqli_next_result($connection);
} catch (\Throwable $th) {
    throw $th;
}
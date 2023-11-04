<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!DOCTYPE html>

<html>
    <head>
        <title>Find Customer Demo</title>
        <script src="basket.js"></script>
        <link rel="stylesheet" href="home.css">
    </head>
<?php

//Extract the product IDs that were sent to the server
$prodIDs= $_POST['prodIDs'];

//Convert JSON string to PHP array 
$productArray = json_decode($prodIDs, true);

//Output the IDs of the products that the customer has ordered
echo '<h1>Products Sent to Server</h1>';
for($i=0; $i<count($productArray); $i++){
    echo '<p>Product ID: ' . $productArray[$i]['id'] . '. Count: ' . $productArray[$i]['count'] . '</p>';
}
echo'<button onclick="checkoutUpdates()"> Checkout</button>';
echo'<div ><button onclick="goback()">Back</button></div>';
echo'<div id="checkOutput"></div>';
echo'<div ></div>';
/* Next steps:
 * Get the customer ID from the $_SESSION variable or request customer's details.
 * Add an order document to the database containing product IDs, customer ID, date, count, price etc.
 * Update stock counts in product database.
 * Display confirmation page to customer.
 */

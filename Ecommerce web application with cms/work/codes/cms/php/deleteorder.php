<!-- Calling php function to output navigataion bar 
and it pass along the page title  -->

<?php
        include 'common_cms.php';
        outputheader_and_navbar("Home") 
?>

<?php 


if($_POST){
    
    require __DIR__ . '/vendor/autoload.php';
    
    $mongoClient = (new MongoDB\Client);

    $db = $mongoClient->ecommerce;
    $collection = $db->Orders;

    $orderID = filter_input(INPUT_POST, 'orderID', FILTER_SANITIZE_STRING);
    echo $orderID;

    //perform delete
    $deleteCriteria = [
        "_id" => new MongoDB\BSON\ObjectID($orderID)
    ];
    
    $delete_order = $collection->deleteOne($deleteCriteria);

      //if deleted, refresh order page
      if ($delete_order->getDeletedCount() == 1) {
        echo '<script>alert("Order removed successfully!");</script>';
        echo '<script>window.location.href="vieworder.php";</script>'; 
        
    } else {
        echo '<script>alert("Order ID not found!");</script>'; 
        // echo '<script>window.location.href="vieworder.php";</script>'; 
        
    }
    
}

?> 

<!-- Linking css file and adding a title to the page 
which will be pass along the php function above-->

<title>Delete Order</title>
<link rel="stylesheet" href="../css/common_cms.css">

</div>

<!-- Adding a header using style to align the header in the center of the page 
and using form to add some input fields for the staff to delete a product  -->

<h1 style="text-align: center;">DELETE Customer Order</h1>


  <form id="ID-DELETE" action="deleteorder.php" method="post">
    <label for="id">Enter Order ID:</label>
    <input id="orderID" name="orderID" type="text" value=""><br>
    <input type="submit" value="Submit">
 </form>


</body>
</html>
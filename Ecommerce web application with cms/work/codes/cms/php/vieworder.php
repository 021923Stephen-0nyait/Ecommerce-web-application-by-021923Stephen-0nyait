<!-- Calling php function to output navigataion bar 
and it pass along the page title  -->

<?php
        include 'common_cms.php';
        outputheader_and_navbar("Home") 
?>

<?php

    require __DIR__ . '/vendor/autoload.php';
    
    
    $mongoClient = (new MongoDB\Client);


    $db = $mongoClient->ecommerce;

    $orders = $db->Orders->find();
    

?>

<!-- Linking css file and adding a title to the page 
which will be pass along the php function above-->
<!-- Adding a header using style to align the header in the center of the page 
and using table to add some data about Customer Order -->

  <title>Customer Order</title>
  <link rel="stylesheet" href="../css/common_cms.css">

<h1 style="text-align: center;">Customer Order</h1>
            
  <table class="center">
    <thead>
      <tr>
      <th>Order ID</th>
      <th>Quantity</th>
      <th>Product Bought</th>
      <th>Total</th>
      <th>Customer Email</th>
      <th>Purchase Date</th>    
      
      </tr>
    </thead>
    <tbody>
    <?php 
        if($orders){
            foreach($orders as $order){ ?>

      <tr>
        <td><?=  $order['_id'] ?></td>
        <td><?=  $order['Quantity'] ?></td>
        <td><?=  $order['Product_Bought'] ?></td>
        <td><?=  $order['Total'] ?></td>
        <td><?=  $order['Customer_Email'] ?></td>
        <td><?=  $order['Purchase_Date'] ?></td>
        

      </tr>
        
      <?php }
        } ?>
    </tbody>
  </table>


  </body>
</html>
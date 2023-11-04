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
    
    $products = $db->Product->find();
?>

<!-- Linking css file and adding a title to the page 
which will be pass along the php function above-->
<!-- Adding a header using style to align the header in the center of the page 
and using table to add some data about Products -->

  <title>Product List</title>
  <link rel="stylesheet" href="../css/common_cms.css">
  <h1 style="text-align: center;">Products</h1>

            
<table class="center">
   <thead>
     <tr>
       <th>ID</th>
       <th>Name</th>
       <th>Image url</th>
       <th>Color</th>
       <th>Category</th>
       <th>Stock_Available</th>
       <th>Size</th>
       <th>Price(Rs)</th>
     </tr>
   </thead>
   <tbody>
       
       <?php 
       if($products){
           foreach($products as $product){ ?>
       
       
       <tr>
       <td><?=  $product['_id'] ?></td>
       <td><?=  $product['Product_Name'] ?></td>
       <td><?=  $product['Image_URL'] ?></td>
       <td><?=  $product['Color'] ?></td>
       <td><?=  $product['Category'] ?></td>
       <td><?=  $product['Stock_Available'] ?></td>
       <td><?=  $product['Size'] ?></td>
       <td><?=  $product['Price'] ?></td>
     </tr>
       
       
       <?php }
       } ?>
   </tbody>
 </table>

  </body>
</html>
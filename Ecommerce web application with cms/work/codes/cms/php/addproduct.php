<!-- Calling php functunction to output navigataion bar 
and it pass along the page title  -->
<script>
if( !array_key_exists("loggedInUserEmail", $_SESSION) ){
    window.location.replace("StaffLogin.php");
    return;
}
</script>
<?php
        include 'common_cms.php';
        outputheader_and_navbar("Home") 
?>

<?php 

$success = false;
$error = false;

if($_POST){
    
    require __DIR__ . '/vendor/autoload.php';
    
    
    
    $mongoClient = (new MongoDB\Client);


    $db = $mongoClient->ecommerce;
    
    $insertResult = $db->Product->insertOne($_POST);
    
    if($insertResult->getInsertedCount()==1){      
        $success = 'Product added successfully';
    }
    else {
        $error = 'unable to add product';
    }
    
}

?> 

<!-- Linking css file and adding a title to the page 
which will be pass along the php function above-->

<title>Add Product</title>
<link rel="stylesheet" href="../css/common_cms.css">  

<!-- Adding a header using style to align the header in the center of the page 
and using form to add some input fields for the staff to add a product  -->

<h1 style="text-align: center;">ADD PRODUCT</h1>

<div class="edited">
  <?php 
        
        if($success){
                echo '<p style="color:green;">'.$success.'</p><br>';
        }elseif($error){
            echo '<p style="color:red;">'.$error.'</p><br>';
        }
    
    ?>
<form method='post' action='addproduct.php'>

    <input type="text" name="Product_Name" placeholder="Enter Product Name" value=""><br>
    <input type="text" name="Color" placeholder="Enter Product Color"  value=""><br>
    <input type="text" name="Size" placeholder="Enter size of the Product"  value=""><br>
    <input type="text" name="Image_URL" placeholder="Enter Product Image URL" value=""><br>
    <input type="text" name="Category" placeholder="Enter Product Category" value=""><br>
    <input type="text" name="Price" placeholder="Enter Product Price" value=""><br>
    <input type="text" name="Stock_Available" placeholder="Enter Product Stock" value="">
    <input type="submit" id="submit-btn" value="Submit">

  </form>
</div>



  </body>
</html>
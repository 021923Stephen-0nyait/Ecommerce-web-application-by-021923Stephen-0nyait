<?php
    require __DIR__ . '/vendor/autoload.php';
    $mongoClient = (new MongoDB\Client);
    $db = $mongoClient ->ecommerce;
    $collection = $db->Product;


    $PID = filter_input(INPUT_POST, 'textIDEdit', FILTER_SANITIZE_STRING);

    echo $PID;


    if (isset($PID)){
        $Obj_id  = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($PID)]);
        // return $Obj_id;
    }

    if(isset($_POST['submit'])){
        
            $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($PID)],
            ['$set' => [
                'Product_Name'=>$_POST['Product_Name'],
                'Image_URL'=>$_POST['Image_URL'],
                'Color'=>$_POST['Color'],
                'Category'=>$_POST['Category'],
                'Stock_Available'=>$_POST['Stock_Available'],
                'Size'=>$_POST['Size'],
                'Price'=>$_POST['Price']
                ]]);

        }

    ?>
    

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Product</title>
    </head>
    <body>
        <div class="containerEP">
            <br>
 
                <h1>Edit Product</h1>

            <br>
            <br>
            <form method="post">
                <div class="EPMainContainer">
                    <strong>Product Name :</strong>
                    <input type="text" value='<?php echo "$Obj_id->Product_Name"?>' name="Product_Name" required="" placeholder="xxxxxxxx">
                    <br>
                    <strong>Image_URL:</strong>
                    <input type="text" value="<?php echo "$Obj_id->Image_URL"?>" name="Image_URL" required="" placeholder="xxxxxxxx">
                    <br>
                    <strong>Color :</strong>
                    <input type="text" value="<?php echo "$Obj_id->Color"?>" name="Color" required="" placeholder="xxxxxxxx">
                    <br>
                    <strong>Category:</strong>
                    <input type="text" value="<?php echo "$Obj_id->Category"?>" name="Category" required="" placeholder="xxxxxxxx">
                    <br>
                    <strong>Stock:</strong>
                    <input type="text" value="<?php echo "$Obj_id->Stock_Available"?>" name="Stock_Available" required="" placeholder="xxxxxxxx">
                    <br>
                    <strong>Size :</strong>
                    <input type="text" value="<?php echo "$Obj_id->Size"?>" name="Size" required="" placeholder="xxxxxxxx">
                    <br>
                    <strong>Price :</strong>
                    <input type="text" value="<?php echo "$Obj_id->Price"?>" name="Price" required="" placeholder="xxxxxxxx">
                    <br>
                    
                    <br>
                    <button type="submit" name="submit" class="btn btn-success" style="padding-left: 30px; border-radius: 30px; padding-right: 30px;">Save</button>
                </div>
            </form>
        </div>
        
    </body>
    </html>
    <?php 
    foreach( $Obj_id as $variableName ) {
        // action to perform
        echo "$variableName'<br>'";
        $result= array_slice($variableName,3);
        echo $result;
    }
     
    ?>
        

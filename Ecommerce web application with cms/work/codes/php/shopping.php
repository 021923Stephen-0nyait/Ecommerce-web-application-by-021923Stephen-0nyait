<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->ecommerce;
//Extract the product IDs that were sent to the server

$basketContent = filter_input(INPUT_POST, 'basket', FILTER_SANITIZE_STRING);
$basketQuantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);
$dayof = filter_input(INPUT_POST, 'dayof', FILTER_SANITIZE_STRING);
//Convert JSON string to PHP array 
//$productArray = json_decode($prodIDs, true);
if( !array_key_exists("loggedInUserEmail", $_SESSION) ){
    echo 'false';
    return;
}
$idArray = explode(",",$basketContent);
$quantityArray = explode(",",$basketQuantity);

for ($i = 0; $i < count($idArray); $i++){
    $findCriteria =['Product_Name' =>$idArray[$i]];
    $cursor = $db->Product->findOne($findCriteria);
    $getPrice=$cursor['Price']*$quantityArray[$i];


    if($quantityArray[$i]<$cursor['Stock_Available']){
        $getQuantity=$cursor['Stock_Available']-$quantityArray[$i];
        $updateResult = $db->Product->updateOne(
            ['Product_Name' => $idArray[$i]],
            ['$set' => ['Stock_Available' => $getQuantity]]
        );
        $addOrder=$db->Orders->insertOne(
            ['Quantity' =>$quantityArray[$i],'Product_Bought' =>$idArray[$i],'Total'=>$getPrice,'Customer_Email'=>$_SESSION['loggedInUserEmail'],"Purchase_Date"=>$dayof]
        );
    }
    else{
        $getQuantity=$cursor['Stock_Available']-$cursor['Stock_Available'];
        $updateResult = $db->Product->updateOne(
            ['Product_Name' => $idArray[$i]],
            ['$set' => ['Stock_Available' => $getQuantity]]
        );
        echo"last stock";
        $addOrder=$db->Orders->insertOne(
            ['Quantity' =>$cursor['Stock_Available'],'Product_Bought' =>$idArray[$i],'Total'=>$getPrice,'Customer_Email'=>"cus@mail.com","Purchase_Date"=>$dayof]
        );

    }
}
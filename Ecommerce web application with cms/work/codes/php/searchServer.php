<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
   
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->ecommerce;

$search_string = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_STRING);
$order = filter_input(INPUT_GET, 'order', FILTER_SANITIZE_STRING);


$findCriteria = [
    '$text' => [ '$search' => $search_string ]
 ];
$descend =[ 'sort' =>['Price' => -1 ]];
$ascend =[ 'sort' =>['Price' => 1 ]];
$cursor = $db->Product->find($findCriteria);

$count=0;
foreach ($cursor as $cust){
    $count++;
}

if ($count>0){
    if ($order=="descend"){
        $cursor = $db->Product->find($findCriteria,$descend);
        $phrase = "[";
        foreach ($cursor as $cust){
            $valuetoencode= array("productID"=>$cust['_id'], "product"=>$cust['Product_Name'], "price" =>$cust['Price'],"image"=>$cust['Image_URL'],"quantity"=>$cust['Stock_Available']);
            $phrase .= json_encode($valuetoencode);
            $phrase .= ",";
        }
        $newPhrase = substr($phrase,0,-1);
        $newPhrase .= "]";
        echo $newPhrase;
    }

    elseif  ($order=="ascend"){
        $cursor = $db->Product->find($findCriteria,$ascend);
        $phrase = "[";
        foreach ($cursor as $cust){
            $valuetoencode= array("productID"=>$cust['_id'], "product"=>$cust['Product_Name'], "price" =>$cust['Price'],"image"=>$cust['Image_URL'],"quantity"=>$cust['Stock_Available']);
            $phrase .= json_encode($valuetoencode);
            $phrase .= ",";
        }
        $newPhrase = substr($phrase,0,-1);
        $newPhrase .= "]";
        echo $newPhrase;
    }

    else {
        $cursor = $db->Product->find($findCriteria);
        $phrase = "[";
        foreach ($cursor as $cust){
            $valuetoencode= array("productID"=>$cust['_id'], "product"=>$cust['Product_Name'], "price" =>$cust['Price'],"image"=>$cust['Image_URL'],"quantity"=>$cust['Stock_Available']);
            $phrase .= json_encode($valuetoencode);
            $phrase .= ",";
        }
        $newPhrase = substr($phrase,0,-1);
        $newPhrase .= "]";
        echo $newPhrase;
    }

}
else{
    echo 'Product not Found';
}
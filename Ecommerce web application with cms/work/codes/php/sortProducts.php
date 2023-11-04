<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->ecommerce;


$order = filter_input(INPUT_GET, 'order', FILTER_SANITIZE_STRING);


$descend =[ 'sort' =>['Price' => -1 ]];
$ascend =[ 'sort' =>['Price' => 1 ]];
$productsAscend = $db->Product->find([],$ascend);
$productsDescend = $db->Product->find([],$descend);
$count=0;
$cursor = $db->Product->find();

if ($order=="ascend"){
    
    $AscendInfo ="";
    foreach ($productsAscend as $document) {
        $AscendInfo .='<div class="column-2">';
        $AscendInfo .= '<img src='.$document["Image_URL"].'>';
        $AscendInfo .='<div class="over_image_text">';
        $AscendInfo .='  <div><button class="Add_Cart" onclick=\'addToBasket("' . $document["_id"] . '", "' . $document["Product_Name"] . '")\' >Add to Cart</button></div>';
        $AscendInfo .='</div>';
        $AscendInfo .= '<h5>' . $document["Product_Name"] . "</h5>";
        $AscendInfo .= '<p>Rs.' . $document["Price"] . "</p>";
        $AscendInfo .= '</div>';
        
    }
    echo $AscendInfo;
    
}

else if ($order=="descend"){
    
    $AscendInfo ="";
    foreach ($productsDescend as $document) {
        $AscendInfo .='<div class="column-2">';
        $AscendInfo .= '<img src='.$document["Image_URL"].'>';
        $AscendInfo .='<div class="over_image_text">';
        $AscendInfo .='  <div><button class="Add_Cart" onclick=\'addToBasket("' . $document["_id"] . '", "' . $document["Product_Name"] . '")\' >Add to Cart</button></div>';
        $AscendInfo .='</div>';
        $AscendInfo .= '<h5>' . $document["Product_Name"] . "</h5>";
        $AscendInfo .= '<p>Rs.' . $document["Price"] . "</p>";
        $AscendInfo .= '</div>';
        
    }
    echo $AscendInfo;
    
}

else{
    echo 'Product not Found';
}


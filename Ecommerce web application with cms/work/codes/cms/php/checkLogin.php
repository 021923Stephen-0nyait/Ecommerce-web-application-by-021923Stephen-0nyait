<?php
    //Start session management
    session_start();

    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $text= filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);    

    require __DIR__ . '/vendor/autoload.php';

    //Connect to MongoDB and select database
    $mongoClient = (new MongoDB\Client);
    $db = $mongoClient->ecommerce;

    //Create a PHP array with our search criteria
    $findCriteria = [ "UserID" => $text ];

    //Find all of the customers that match  this criteria
    //$cursor = $db->Staff->find($findCriteria);

    $collection=$db->Staff;

    //Find all of the customers that match  this criteria
    //Find all of the customers that match  this criteria
    $resultArray = $collection->find($findCriteria)->toArray();

    //Check that there is exactly one customer
    if(count($resultArray) == 0){
        echo 'Customer email not found';
        return;
    }
    else if(count($resultArray) > 1){
        echo 'Database error: Multiple customers have same email address.';
        return;
    }
   
    //Get customer and check password
    $customer = $resultArray[0];
    if($customer['Password'] != $password){
        echo 'Password incorrect.';
        return;
    }
        
    //Start session for this user
    $_SESSION['loggedInUserEmail'] = $text;
    
    //Inform web page that login is successful
    echo 'ok';  
?>   
 <script>
    if( !array_key_exists("loggedInUserEmail", $_SESSION) ){
        window.location.replace("StaffLogin.php");
        return;
 </script>
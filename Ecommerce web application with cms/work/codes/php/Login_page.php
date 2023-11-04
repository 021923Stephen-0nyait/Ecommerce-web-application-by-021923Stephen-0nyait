<?php
    session_start();
    
    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $login_mail= filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING);
    $login_password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);
    if($login_mail != "" && $login_password != "" ){
    //Check query parameters 
        //STORE REGISTRATION DATA IN MONGODB
        //Create instance of MongoDB client
    require __DIR__ . '/vendor/autoload.php';
    $mongoClient = (new MongoDB\Client);

    // //Select a database
    $db = $mongoClient->ecommerce;

    $findCriteria = [ "Email" => $login_mail ];

    $resultArray =$db->Customer->find($findCriteria)->toArray();
  

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
    if($customer['Password'] != $login_password){
        echo 'Password incorrect.';
        return;
    }

    //Start session for this user
    $_SESSION['loggedInUserEmail'] = $login_mail;
    
    //Inform web page that login is successful
    echo 'Logged in'. $login_mail;  
}
else{
    echo 'login not successful';
}

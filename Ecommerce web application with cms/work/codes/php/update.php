<?php
    require __DIR__ . '/vendor/autoload.php';
    session_start();
    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $FirstName= filter_input(INPUT_POST, 'FirstName', FILTER_SANITIZE_STRING);
    $LastName = filter_input(INPUT_POST, 'LastName', FILTER_SANITIZE_STRING);
    $Email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING);
    $Street = filter_input(INPUT_POST, 'Street', FILTER_SANITIZE_STRING);
    $City = filter_input(INPUT_POST, 'City', FILTER_SANITIZE_STRING);
    $Country = filter_input(INPUT_POST, 'Country', FILTER_SANITIZE_STRING);
    $ZIPcode = filter_input(INPUT_POST, 'ZIPcode', FILTER_SANITIZE_NUMBER_INT);
    $PhoneNo = filter_input(INPUT_POST, 'PhoneNo', FILTER_SANITIZE_STRING);
    $Password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);
    if($FirstName != "" && $password != "" && $Email != "" && $Street != "" && $City != "" && $Country != "" && $ZIPcode != "" && $PhoneNo != "" && $Password != "" ){//Check query parameters 
        //STORE REGISTRATION DATA IN MONGODB
        //Create instance of MongoDB client
    $mongoClient = (new MongoDB\Client);
    

    //Select a database
    $db = $mongoClient->ecommerce;
    $email=$_SESSION['loggedInUserEmail'];
    $findCriteria = [
    "Email"=>$email 
    ];

    //assign value from client to variable
    
    $updateCriteria =[

        "FirstName" => $FirstName,
        "LastName" => $LastName,
        "Email" => $Email,
        "Street" => $Street,
        "City" => $City,
        "Country" => $Country,
        "ZIPcode" => $ZIPcode,
        "PhoneNo" => $PhoneNo,
        "Password" => $Password,

    ];

    $update = $db->Customer->replaceOne($findCriteria,$updateCriteria);
    
        //Output message confirming registration
        echo 'Update done for  ' . $FirstName;
    }
    else{//A query string parameter cannot be found
        echo 'change failed';
    }
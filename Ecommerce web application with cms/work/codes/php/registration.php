<?php

    //Include libraries
    require __DIR__ . '/vendor/autoload.php';
    
    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $signup_Fname= filter_input(INPUT_POST, 'signup_Fname', FILTER_SANITIZE_STRING);
    $signup_Lname = filter_input(INPUT_POST, 'signup_Lname', FILTER_SANITIZE_STRING);
    $signup_mail = filter_input(INPUT_POST, 'signup_mail', FILTER_SANITIZE_STRING);
    $signup_street= filter_input(INPUT_POST, 'signup_street', FILTER_SANITIZE_STRING);
    $signup_city = filter_input(INPUT_POST, 'signup_city', FILTER_SANITIZE_STRING);
    $signup_country = filter_input(INPUT_POST, 'signup_country', FILTER_SANITIZE_STRING);
    $signup_zip= filter_input(INPUT_POST, 'signup_zip', FILTER_SANITIZE_STRING);
    $signup_num = filter_input(INPUT_POST, 'signup_num', FILTER_SANITIZE_STRING);
    $signup_password = filter_input(INPUT_POST, 'signup_password', FILTER_SANITIZE_STRING);
    
    if($signup_Fname != "" && $signup_Lname != "" && $signup_mail != "" && $signup_street != "" && $signup_city != "" && $signup_country != "" && $signup_zip != "" && $signup_num != "" && $signup_password != ""){

        //Check query parameters 
        //STORE REGISTRATION DATA IN MONGODB
        //Create instance of MongoDB client
        $mongoClient = (new MongoDB\Client);
        //Select a database
        $db = $mongoClient->ecommerce;
        //Select a collection 
        $collection = $db->Customer;
        $cursor=$collection->find(['Email'=> $signup_mail]);
        $count=0;
        foreach($cursor as $cur){
            $count=$count+1;
        }
        if($count>0){
            echo "User Exists";
        }
        else{
            $dataArr =[
        
                "FirstName" => $signup_Fname,
                "LastName" => $signup_Lname,
                "Email" => $signup_mail,
                "Street" => $signup_street,
                "City" => $signup_city,
                "Country" => $signup_country,
                "ZIPcode" => $signup_zip,
                "PhoneNo" => $signup_num,
                "Password" => $signup_password
            ];
        
            $Customer = $collection->insertOne($dataArr);
            
                //Output message confirming registration
                echo 'Thank you for registering ' . $signup_Fname;
            }
    }
            else{//A query string parameter cannot be found
                echo 'Registration data missing';
            }
        
        
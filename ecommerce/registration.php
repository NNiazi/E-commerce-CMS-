<?php
//Connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->el_arte;

//Select a collection 
$collection = $db->users;


    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $name= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $surname= filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $username= filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirmpassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
    $address= filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

//Convert to PHP array
$dataArray = [
    "Name" => $name, 
    "Surname" => $surname,
    "Username" => $username,
    "Password" => $password,
    "Confirm_Password" => $confirmpassword,
    "Address" => $address,
    "Phone" => $phone,
 ];

//Add the new product to the database
$returnVal = $collection->insert($dataArray);
    
    if($name != "" && $surname != "" && $username != "" && $password != "" && $confirmpassword != "" && $address != "" && $phone){//Check query parameters 
        //STORE REGISTRATION DATA IN MONGODB
    
        //Output message confirming registration
        echo 'Thank you for registering ' . $name;
    }
    else{//A query string parameter cannot be found
        echo 'Registration data missing';
    }

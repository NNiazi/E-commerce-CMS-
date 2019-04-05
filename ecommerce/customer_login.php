<?php
    //Start session management
    session_start();

    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $email= filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);    

    //Connect to MongoDB and select database
    $mongoClient = new MongoClient();
    $db = $mongoClient->el_arte;

    //Create a PHP array with our search criteria
    $findCriteria = [
        "Username" => $email, 
     ];

    //Find all of the customers that match  this criteria
    $cursor = $db->users->find($findCriteria);

    //Check that there is exactly one customer
    if($cursor->count() == 0){
        echo 'username not recognized.';
        return;
    }
    else if($cursor->count() > 1){
        echo 'Database error: Multiple customers have same username.';
        return;
    }
   
    //Get customer
    $users = $cursor->getNext();
    
    //Check password
    if($users['Password'] != $password){
        echo 'Password incorrect.';
        return;
    }
        
    //Start session for this user
    $_SESSION['loggedInUserEmail'] = $email;
    
    //Inform web page that login is successful
    echo 'You have successfully logged in as: ' . $email;


    
    //Close the connection
    $mongoClient->close();
    
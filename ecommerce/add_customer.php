<?php
//Connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->el_arte;

//Select a collection 
$collection = $db->users;

//Extract the data that was sent to the server
$name= filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_STRING);
$surname= filter_input(INPUT_POST, 'Surname', FILTER_SANITIZE_STRING);
$username= filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);
$confirmpassword = filter_input(INPUT_POST, 'Confirm_Password', FILTER_SANITIZE_STRING);
$phone = filter_input(INPUT_POST, 'Phone', FILTER_SANITIZE_STRING);

//Convert to PHP array
$dataArray = [
    "Name" => $name, 
    "Surname" => $surname,
    "Username" => $username,
    "Password" => $password,
    "Confirm_Password" => $confirmpassword,
    "Phone" => $phone,
 ];

//Add the new product to the database
$returnVal = $collection->insert($dataArray);
     
//Echo result back to user
if($returnVal['ok']==1){
    echo file_get_contents("index.php");
}
else {
    echo 'Error adding customer';
}

//Close the connection
$mongoClient->close();






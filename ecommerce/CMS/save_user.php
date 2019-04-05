<?php
//Connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->el_arte;

//Extract the customer details 
$_id = filter_input(INPUT_POST, '_id', FILTER_SANITIZE_STRING);
$name= filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_STRING);
$surname= filter_input(INPUT_POST, 'Surname', FILTER_SANITIZE_STRING);
$username= filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);
$confirm_password = filter_input(INPUT_POST, 'Confirm_Password', FILTER_SANITIZE_STRING);
$phone= filter_input(INPUT_POST, 'Phone', FILTER_SANITIZE_STRING);


//Construct PHP array with data
$customerData = [
    "_id" => new MongoId($_id),
    "Name" => $name,
    "Surname" => $surname,
    "Username" => $username,
    "Password" => $password,
    "Confirm_Password" => $confirm_pasword,
    "Phone" => $phone,
    
    
];

//Save the product in the database - it will overwrite the data for the product with this ID
$returnVal = $db->users->save($customerData);
    
//Echo result back to user
if($returnVal['ok']==1){
    echo 'User details have been updated successfully';
    echo '<br><button type="button"><a href="usersRegistered.php"></a>Update Next User</button>';
}
else {
    echo 'Error saving customer';
}

//Close the connection
$mongoClient->close();



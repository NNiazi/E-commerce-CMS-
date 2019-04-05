<?php
//Start session management
session_start();

//Get name and address strings - need to filter input to reduce chances of SQL injection etc.
$email= filter_input(INPUT_POST, 'usernamei', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'passwordi', FILTER_SANITIZE_STRING); 

//Connect to MongoDB and select database
$mongoClient = new MongoClient();
$db = $mongoClient->el_arte;

//Create a PHP array with our search criteria
$findCriteria = [
"usernamei" => $email, 
];

//Find all of the customers that match this criteria
$cursor = $db->admin->find($findCriteria);

//Check that there is exactly one customer
if($cursor->count() == 0){
echo 'Email not recognized.';
return;
}
else if($cursor->count() > 1){
echo 'Database error: Multiple customers have same email address.';
return;
}

//Get customer
$admin = $cursor->getNext();

//Check password
if($admin['passwordi'] != $password){
echo 'Password incorrect.';
return;
}
//Start session for this user
$_SESSION['loggedInCMSUsernameId'] = $email;

//Inform web page that login is successful
echo 'ok'; 
//header to a page
header('Location: orders.php');
//Close the connection
$mongoClient->close();

?>

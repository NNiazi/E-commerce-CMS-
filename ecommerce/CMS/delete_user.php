<?php

//Connect to MongoDB
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->el_arte;

//Extract ID from POST data
$custID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

//Build PHP array with remove criteria 
$remCriteria = [
    "_id" => new MongoId($custID)
];

//Delete the customer document
$returnVal = $db->users->remove($remCriteria);
    
//Echo result back to user
if($returnVal['ok']==1){
    echo 'Ok ' . $returnVal['n'] . ' documents deleted.';
}
else{
   echo 'Error deleting product';
}

//Close the connection
$mongoClient->close();

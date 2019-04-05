<?php
//Connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->el_arte;

//Extract the customer details 
$_id = filter_input(INPUT_POST, '_id', FILTER_SANITIZE_STRING);
$image_url= filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_STRING);
$name= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$description= filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$width = filter_input(INPUT_POST, 'width', FILTER_SANITIZE_STRING);
$height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING);
$price= filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
$stock_count= filter_input(INPUT_POST, 'stock_count', FILTER_SANITIZE_STRING);


//Construct PHP array with data
$customerData = [
    "_id" => new MongoId($_id),
    "image_url" => $image_url,
    "name" => $name,
    "description" => $description,
    "width" => $width,
    "height" => $height,
    "price" => $price,
    "stock_count" => $stock_count,
    
    
];

//Save the product in the database - it will overwrite the data for the product with this ID
$returnVal = $db->products->save($customerData);
    
//Echo result back to user
if($returnVal['ok']==1){
    echo 'Product details have been updated successfully';
    echo '<br><button type="button"><a href="CMSproducts.php"></a>Update Next Product</button>';
}
else {
    echo 'Error saving customer';
}

//Close the connection
$mongoClient->close();



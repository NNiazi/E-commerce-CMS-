<?php
//Connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->el_arte;

//Select a collection 
$collection = $db->products;

//Extract the data that was sent to the server
$image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$keywords = filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$width = filter_input(INPUT_POST, 'width', FILTER_SANITIZE_STRING);
$height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
$stock_count = filter_input(INPUT_POST, 'stock_count', FILTER_SANITIZE_STRING);

//Convert to PHP array
$dataArray = [
	"image_url" => $image_url,
    "name" => $name, 
    "keywords" => $keywords,
    "description" => $description, 
    "width" => $width,
    "height" => $height,
    "price" => $price,
    "stock_count" => $stock_count

 ];

//Add the new product to the database
$returnVal = $collection->insert($dataArray);
    
//Echo result back to user
if($returnVal['ok']==1){
    echo 'ok';
}
else {
    echo 'Error adding customer';
}

//Close the connection
$mongoClient->close();






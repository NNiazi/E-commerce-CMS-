<?php

include 'common.php';
outputHeader();

//Connect to MongoDB
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->el_arte;

//Extract the data that was sent to the server
$search_string = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);

//Create a PHP array with our search criteria
$findCriteria = [
    '$text' => [ '$search' => $search_string ] 
 ];

//Find all of the customers that match  this criteria
$cursor = $db->products->find($findCriteria);

//Output the results
foreach ($cursor as $cust){
    echo '<div id="productsForSale">Products For Sale</div>';
    echo '<div id="content3">';
    echo '<div id="wrap">';
    echo '<div class="columns_4" id="columns">';
    echo '<figure>';
    echo '<img src="' . $cust["image_url"] .'">';
    echo '<figcaption>' . $cust["description"] . "</figcaption>";
    echo '<span class="price" style="color:black;"£>' . $cust["price"] . "</span>";
    echo '<a class="button" class="btn add2cart" onclick=\'basket.add("' . $cust["_id"] . '","' . $cust["name"] . '","' . $cust["description"] . '", "' . $cust["price"] . '", 1)\'>';
    echo '<span class="glyphicon glyphicon-shopping-cart"></span>Add to cart</a>';
    echo '</figure>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '</div>'; 
}


//Close the connection
$mongoClient->close(); 






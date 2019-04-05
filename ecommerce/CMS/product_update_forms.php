<?php
//Connect to MongoDB
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->el_arte;

//Extract the data that was sent to the server
$search_string = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);

//Create a PHP array with our search criteria
$findCriteria = [
    'barcode' => $search_string
 ];

//Find all of the customers that match  this criteria
$cursor = $db->products->find($findCriteria);

//Output the results as forms


foreach ($cursor as $cust){
    echo '<form action="save_products.php" id="existingProductForm" class="form-horizontal" method="post">';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Image_url</label>  
                <div class="col-md-4">
                <input name="image_url" type="text" placeholder="Image_url" class="form-control input-md" value="' . $cust['image_url'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Barcode</label>  
                <div class="col-md-4">
                <input name="image_url" type="text" placeholder="Image_url" class="form-control input-md" value="' . $cust['_id'] . '" required> 
                </div>
          </div>'; 
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Name</label>  
                <div class="col-md-4">
                <input name="name" type="text" placeholder="Name" class="form-control input-md" value="' . $cust['name'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Description</label>  
                <div class="col-md-4">
                <input name="description" type="text" placeholder="Description"  class="form-control input-md" value="' . $cust['description'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Width</label>  
                <div class="col-md-4">
                <input name="width" type="text" placeholder="eg. 24meters" class="form-control input-md" value="' . $cust['width'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Height</label>  
                <div class="col-md-4">
                <input name="height" type="text" placeholder="eg. 24meters" class="form-control input-md" value="' . $cust['height'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Price</label>  
                <div class="col-md-4">
                <input name="price" class="form-control" placeholder="£0.00" class="form-control input-md" value="' . $cust['price'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Stock</label>  
                <div class="col-md-4">
                <input name="stock_count" type="text" placeholder="Qty" class="form-control input-md" value="' . $cust['stock_count'] . '" required> 
                </div>
          </div>';
    echo '<button id="saveButton" type="submit" class="btn btn-success">Save</button>';
    echo '</form>';
}

//Close the connection
$mongoClient->close();

 






                        
                        
                            

        
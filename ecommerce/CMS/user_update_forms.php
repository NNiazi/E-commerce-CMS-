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
$cursor = $db->users->find($findCriteria);

//Output the results as forms


foreach ($cursor as $cust){
    echo '<form action="save_user.php" id="existingUserForm" class="form-horizontal" method="post">';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">ID</label>  
                <div class="col-md-4">
                <input name="id" type="text" placeholder="id" class="form-control input-md" value="' . $cust['_id'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Name</label>  
                <div class="col-md-4">
                <input name="Name" type="text" placeholder="Name" class="form-control input-md" value="' . $cust['Name'] . '" required> 
                </div>
          </div>'; 
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Surname</label>  
                <div class="col-md-4">
                <input name="Surname" type="text" placeholder="Surname" class="form-control input-md" value="' . $cust['Surname'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Username</label>  
                <div class="col-md-4">
                <input name="Username" type="text" placeholder="Username"  class="form-control input-md" value="' . $cust['Username'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Password</label>  
                <div class="col-md-4">
                <input name="Password" type="text" placeholder="Password" class="form-control input-md" value="' . $cust['Password'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Confirm Password</label>  
                <div class="col-md-4">
                <input name="Confirm_Password" type="text" placeholder="Confirm_Password" class="form-control input-md" value="' . $cust['Confirm_Password'] . '" required> 
                </div>
          </div>';
    echo '<div class="form-group">
            <label class="col-md-4 control-label">Phone</label>  
                <div class="col-md-4">
                <input name="Phone" type="text" placeholder="Phone" class="form-control input-md" value="' . $cust['Phone'] . '" required> 
                </div>
          </div>';
    echo '<button id="saveButton" type="submit" class="btn btn-success">Save</button>';
    echo '</form>';
}

//Close the connection
$mongoClient->close();

 






                        
                        
                            

        
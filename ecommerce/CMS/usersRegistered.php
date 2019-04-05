<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        El Arte CMS
    </title>
    <link href="stylesheetCMS.css" rel="stylesheet" type="text/css">
    <link rel='stylesheet' type='text/css' href='../css/bootstrap.css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/products.js"></script>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="orders.php">Orders</a>
                </li>
                <li>
                    <a href="CMSproducts.php">Products</a>
                </li>
                <li>
                    <a href="usersRegistered.php">Users</a>
                </li>
            </ul>
            <ul class='nav navbar-nav navbar-right'>
                <li data-toggle="dropdown">
                    <a>
                        <?php session_start(); echo $_SESSION['loggedInCMSUsernameId']; ?><span class="caret"></span></a>
                </li>
                <ul class="dropdown-menu">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </ul>
            </li>
            </ul>
        </div>
    </nav>
    <div id="productAdd">
        <div class="container-fluid">
            <h2 class="sub-header">Registered Users</h2>

            <!--    Table to display list of products    -->
            <table class="table table-striped">
                <!--        Column Headings        -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <!--       Table Data         -->
                <tbody>
                    <?php

             //Connect to MongoDB
             $mongoClient = new MongoClient();

             //Select a database
             $db = $mongoClient->el_arte;

             $users = $db->users->find();

             //Output data
             if($users->count() >0){

                foreach ($users as $document){
                     echo 
                        "<tr>
                            <td>" . $document['_id'] . "</td>
                            <td>" . $document['Name'] . "</td>
                            <td>" . $document['Surname'] . "</td>
                            <td>" . $document["Username"] . "m</td>
                            <td>" . $document['Password'] . "m</td>
                            <td>" . $document["Phone"] . "</td>
                            <td>
                        <button class='btn btn-success' data-toggle='modal' data-target='#edit'>Edit</button>
                        <button class='btn btn-danger' data-toggle='modal' data-target='#delete'>Delete</button>
                            </td>
                        </tr>";
                        echo '</tbody>';
                         }
             }
             $mongoClient->close();
             ?>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="edit" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h1 id="productText2">Product Information</h1>
                    </div>
                    <div class="modal-body">
                        <!--            Form to display the data            -->
                        <form action="user_update_forms.php" id="existingProductForm" class="form-horizontal" method="post">
                            <!--             Display each field with data               -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="barcode">Barcode</label>
                                <div class="col-md-4">
                                    <input id="barcode" name="barcode" type="text" placeholder="Barcode" class="form-control input-md" value="5a6a109990d204c23d246f8c">
                                </div>
                            </div>
                            <button id="saveButton" type="submit" class="btn btn-success">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="delete" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 id="productText3">Enter The ID Number Of The User To Delete</h2>
                    </div>

                    <div class="modal-body">
                        <form action="delete_user.php" method="post">
                            <div class="col-md-10">
                                <input name="id" type="text" placeholder="Enter ID of User" class="form-control input-md">
                            </div>
                            <button type="submit" class="btn btn-danger settings">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      El Arte CMS
    </title>
    <link href="stylesheetCMS.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   
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
          <li data-toggle="dropdown"><a><?php session_start(); echo $_SESSION['loggedInCMSUsernameId']; ?><span class="caret"></span></a></li>
          <ul class="dropdown-menu">
            <li><a href="logout.php" >Logout</a></li>
          </ul>
        </ul>
        </ul>
          </li>
        </ul>
      </div>
    </nav>

    <div id="orderEdit">
      <div class="container">
        <div class="container-fluid">
        <h2 class="sub-header">Orders</h2>
        <!--    Table to display list of Orders    -->
        <table class="table table-striped">
            <!--        Column Headings        -->
            <thead>
                <tr>
                    <th>Order No</th>
                    <th>Order Date</th>
                    <th>Customer Address</th>
                    <th>Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <!--       Table Data         -->
             <?php

             //Connect to MongoDB
             $mongoClient = new MongoClient();

             //Select a database
             $db = $mongoClient->el_arte;

             $orders = $db->orders->find();

             //Output data
             if($orders->count() >0){


                foreach ($orders as $document){
                     echo 
                        "<tr>
                            <td>" . $document['_id'] . "</td>
                            <td>" . $document['date'] . "</td>
                            <td>" . $document['shipping_address'] . "</td>
                            <td>" . $document['cost'] . "</td>
                            <td>
                                <!--             Action Buttons               -->
                                <button class='btn btn-primary' id='viewOrderButton' data-toggle='modal' data-target='#viewOrderModal'>View</button>
                                <button class='btn btn-success' id='updateStatusButton' data-toggle='modal' data-target='#updateStatusModal'>Update Status</button>
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

    <!---------------------------------------   Modals   ----------------------------------- -->

    <!--    View Order Modal    -->
    <div id="viewOrderModal" class="modal fade" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h1>Order Details</h1>
                </div>
                <div class="modal-body">
                    <!--            Form to display the data            -->
                    <form id="existingOrderForm" class="form-horizontal" method="post">
                        <!--             Display each field with data               -->

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="orderNumber">Order No</label>  
                            <div class="col-md-4">
                                <input id="orderNumber" name="orderNumber" type="number" class="form-control input-md" value="1000" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="orderCreated">Order Created</label>  
                            <div class="col-md-4">
                                <input id="orderCreated" name="orderCreated" type="datetime" class="form-control input-md" value="18/01/2017 21:50" disabled>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label" for="lastModified">Last Modified</label>  
                            <div class="col-md-4">
                                <input id="lastModified" name="lastModified" type="datetime" class="form-control input-md" value="18/01/2017 21:50" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="status">Status</label>  
                            <div class="col-md-4">
                                <input id="status" name="status" type="text" class="form-control input-md" value="Delivered" disabled>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label" for="customerName">Customer</label>  
                            <div class="col-md-7">
                                <input id="customerName" name="customerName" type="text" class="form-control input-md" value="Ahmed Aziz" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="address">Delivery Address</label>
                            <div class="col-md-4">                     
                                <textarea rows="5" cols="1000" class="form-control" id="address" name="address" disabled>16&#13;&#10Example Street&#13;&#10London&#13;&#10N2 8EP&#13;</textarea>
                            </div>
                        </div>

                        <!--    Table to display Products Purchased    -->
                        <div class="container-fluid">
                            <table class="table table-striped">
                                <!--        Column Headings        -->
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Delivery</th>
                                        <th>Line Price</th>
                                    </tr>
                                </thead>
                                <!--       Table Data         -->
                                <tbody>
                                    <tr>
                                        <td>5a6a109990d204c23d246f8c</td>
                                        <td>Stars</td>
                                        <td></td>
                                        <td>$1.99</td>
                                        <td>$300</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="orderTotal">Order Total</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input id="orderTotal" name="orderTotal" class="form-control" type="text" value="300" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal to Update Order Status  -->
    <div id="updateStatusModal" class="modal fade" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Update Order Status</h2>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="statusSelect">Status</label>
                            <div class="col-md-4">
                                <select id="statusSelect" name="statusSelect" class="form-control">
                                    <option value="Ordered">Ordered</option>
                                    <option value="Dispatched">Dispatched</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal to confirm Order Delete -->
     <div class="modal fade" id="delete" role="dialog">
                <div class="modal-dialog">
                    
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2 id="productText3">Enter tThe ID Number Of The Product To Delete</h2>
                        </div>
                        
                        <div class="modal-body">
                            <form action="delete_product.php" method="post">
                                <div class="col-md-10" >
                                    <input name="id" type="text" placeholder="Enter ID of product" class="form-control input-md">
                                 </div>
                                <button type="submit" class="btn btn-danger settings">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

      </div>
    </div>
  </body>
</html>
<?php 
    function outputHeader(){
        print '<!DOCTYPE html>
        <html lang="en">
          <head>
            <title>
              El Arte
            </title>
            <link href="stylesheet.css" rel="stylesheet" type="text/css">
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
            </script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
            </script>
            <script src="basket.js"></script>
          </head>
          <body>
        
        <!--------------------------------------------------------         Navigation Bar      -------------------------------------------------------->
        
          <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a href="products.php">Products</a>
                        </li>
                        <li>
                            <a href="contacts.php">Contact</a>
                        </li>
                    </ul>
                    <div class="col-sm-3 col-md-3">
                        <form class="example" action="find_customer_indexed_search.php" method="get" style="margin:auto;max-width:300px">
                            <input type="text" placeholder="Search.." name="name">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <ul class="nav navbar-nav navbar-right" id="display">
                        <li>
                            <a data-target="#login" data-toggle="modal" href="#">Login</a>
                        </li>
                        <li>
                            <a data-target="#register" data-toggle="modal" href="#">Register</a>
                        </li>
                        <li class="dropdown">
                            <a href="checkout.php" role="button"><span class="glyphicon glyphicon-shopping-cart"></span></span></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="content">
                <img id="last" src="img/logo2.png">
            </div>
        
            <!--------------------------------------------------------         Login Modal     -------------------------------------------------------->
            <div id="login" class="modal fade" role="dialog">
                <div class="modal-dialog">
        
                    <div id="bk" class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="text-align:center; font-size: 30px; font-family: Harabara; color:black">Login</h4>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control input-sm" placeholder="Username" id="usernamel" required>
                            <input type="password" class="form-control input-sm" placeholder="Password" id="passwordl" required>
                        </div>
                        <div class="modal-footer">
                            <button onclick="login()" class="btn btn-danger">Login</button>
                            <p style="color: black; text-align: center;"> Server Response:<span style="color:black;" id="ErrorMessages"></span></p>
        
                        </div>
                    </div>
                </div>
            </div>
        
            <!--------------------------------------------------------         Login Script      -------------------------------------------------------->
        
            <script>
                //Global variables 
                var loggedInStr = "<ul class=\'nav navbar-nav navbar-right\'><li><a onclick=\'logout()\'>Logout</a></li><li class=\'dropdown\'><a href=\'checkout.php\' role=\'button\'><span class=\'glyphicon glyphicon-shopping-cart\'></span></span></a></li></ul>";
                //"Logged in <button onclick=\'logout()\'>Logout</button>";
                var loginStr = document.getElementById("display").innerHTML;
                var request = new XMLHttpRequest();
        
                //Check login when page loads
                window.onload = checkLogin;
        
                //Checks whether user is logged in.
                function checkLogin() {
                    //Create event handler that specifies what should happen when server responds
                    request.onload = function() {
                        if (request.responseText === "ok") {
                            document.getElementById("display").innerHTML = loggedInStr;
                        } else {
                            console.log(request.responseText);
                            document.getElementById("display").innerHTML = loginStr;
                        }
                    };
                    //Set up and send request
                    request.open("GET", "check_login.php");
                    request.send();
                }
        
                //Attempts to log in user to server
                function login() {
                    //Create event handler that specifies what should happen when server responds
                    request.onload = function() {
                        //Check HTTP status code
                        if (request.status === 200) {
                            //Get data from server
                            var responseData = request.responseText;
        
                            //Add data to page
                            if (responseData === "ok") {
                                document.getElementById("login").innerHTML = loggedInStr;
                                document.getElementById("ErrorMessages").innerHTML = ""; //Clear error messages
                            } else
                                document.getElementById("ErrorMessages").innerHTML = request.responseText;
                        } else
                            document.getElementById("ErrorMessages").innerHTML = "Error communicating with server";
                    };
        
                    //Extract login data
                    var usrEmail = document.getElementById("usernamel").value;
                    var usrPassword = document.getElementById("passwordl").value;
        
                    //Set up and send request
                    request.open("POST", "customer_login.php");
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send("Username=" + usrEmail + "&Password=" + usrPassword);
                }
        
                //Logs the user out.
                function logout() {
                    //Create event handler that specifies what should happen when server responds
                    request.onload = function() {
                        checkLogin();
                    };
                    //Set up and send request
                    request.open("GET", "logout.php");
                    request.send();
                }
            </script>
        <!---         Register Modal      -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="register-modal" role="dialog" style="display: none;" tabindex="-1">
              <div class="modal-dialog">
                <div class="registermodal-container">
                  <h1>
                    Register For Account
                  </h1><br>
                  <form>
                    <input name="Name" placeholder="Name" type="text"> <input name="Surname" placeholder="Surname" type="text"> <input name="Username" placeholder="Username" type="text"> <input name="Password" placeholder="Password" type="password"> <input name="Confirm Password" placeholder="Confirm Password" type="password"> <input name="Phone" placeholder="Phone Number" type="text"> <input class="register registermodal-submit" name="login" type="submit" value="Register">
                  </form>
                  <div class="register-help">
                    <a data-target="#login-modal" data-toggle="modal" href="#">Already registered? Login</a>
                  </div>
                </div>
              </div>
            </div>';
    }
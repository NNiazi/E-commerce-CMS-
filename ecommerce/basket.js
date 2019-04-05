//Constructor for basket object
function Basket(serverBasketPage){
    //Page that interfaces with MongoDB basket
    this.serverBasketPage = serverBasketPage;

    //Holds local copy of basket information
    this.productArray = [];
}


//Adds product to basket
Basket.prototype.add = function(productID, productName, productDescription, quantity, productPrice){
    this.productArray.push({id: productID, name: productName, description: productDescription, quantity: quantity, price: productPrice});
    this.send();
    this.loadBasket();
};


//Removes product from basket
Basket.prototype.remove = function(index){
    this.productArray.splice(index, 1);
    this.send(); 
    this.loadBasket();
};


//Sends modified basket to server
Basket.prototype.send = function(){
    //Create request object 
    var request = new XMLHttpRequest();

    //Create event handler that specifies what should happen when server responds
    request.onload = function(){
        if(request.status === 200){//Check HTTP status code
            //Check response
           if(request.responseText !== 'ok')
               alert("Error sending basket to server: " + request.responseText);
        }
        else
            alert("Error communicating with server: " + request.status);
    };

    //Set up request with HTTP method and URL 
    request.open("POST", this.serverBasketPage);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //Send request
    request.send("json=" + JSON.stringify({products: this.productArray}));
};


//Gets basket from server
Basket.prototype.get = function(){
    //Create request object 
    var request = new XMLHttpRequest();
    
    //Need a reference to the basket class so that we can access it from inner function
    var caller = this;

    //Create event handler that specifies what should happen when server responds
    request.onload = function(){
        if(request.status === 200){//Check HTTP status code
            
            //Get data from server
            var basketJSON = request.responseText;
            
            //Store most accurate version of basket
            caller.productArray = JSON.parse(basketJSON)['products'];

            //Add data to page
            caller.loadBasket();
        }
        else
            alert("Error communicating with server: " + request.status);
    };

    //Set up and send request 
    request.open("GET", this.serverBasketPage);
    request.send();
};


//Loads basket from productArray variable 
Basket.prototype.loadBasket = function(){
    
    //Build HTML string
    var htmlStr = "";
    htmlStr += "<div id='basketeditText'>"
    htmlStr += "</div>";
    htmlStr += "<div class='container'>";
    htmlStr += "<table class='table table-hover table-condensed' id='cart'>";
    htmlStr += "<thead>";
    htmlStr += "<tr>";
    htmlStr += "<th style='color:#000000; width:50%'>Product</th>";
    htmlStr += "<th style='color:#000000; width:10%'>Price</th>";
    htmlStr += "<th style='color:#000000; width:8%''>Quantity</th>";
    htmlStr += "<th style='color:#000000; width:10%''>Action</th></tr>";
    htmlStr += "</thead>"
    for(var i=0; i<this.productArray.length; ++i){
        htmlStr += "<tbody>";
htmlStr += "<tr>";
htmlStr += "<td data-th='Product'>";
htmlStr += "<div class='row'>";
htmlStr += "<div class='col-sm-2 hidden-xs'>";
htmlStr += "<img alt='...' class='img-responsive' src='http://placehold.it/100x100'>";
htmlStr += "</div>";
htmlStr += "<div class='col-sm-10'>";
htmlStr += "<h4 class='nomargin' style='color:#000000;'>" + this.productArray[i].name + "</h4>";
htmlStr += "<p style='color:#000000;'>" + this.productArray[i].description + "</p>";
htmlStr += "</div>";
htmlStr += "</div>";
htmlStr += "</td>";
htmlStr += "<td data-th='Price'>£" + this.productArray[i].quantity + "</td>";
htmlStr += "<td data-th='Quantity'>" + this.productArray[i].price + "</td>";
htmlStr += "<td>" + " <button class='btn btn-danger' onclick='basket.remove(" + i + ")'>Remove</button>" + "</td>";
htmlStr += "</tr>";
htmlStr += "</tbody>"
    }
    
    //Add HTML to page
    document.getElementById("BasketDiv").innerHTML = htmlStr;
};











                  
                
                
                  
                   
                  
     
           







      
    
    
      
        
            
            
            
            
        






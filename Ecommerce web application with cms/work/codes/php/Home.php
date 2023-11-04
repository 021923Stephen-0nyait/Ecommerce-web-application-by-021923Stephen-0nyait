 <!---Link for social media icons-->

<!-- Linking css file and adding a title to the page 
which will be pass along the php function above -->

<title>Home</title>
<link rel="stylesheet" href="/work/codes/css/home.css">
<style>
  table, th, td {
      border: 2px solid white;
      border-collapse: collapse;                
      width: 950px;
      text-align: center;
      background: white;
      
  }
  th{
    background: #E3CDC7;
    padding: 20px;
  }
  .toleft{
      position: relative;
      left: 270px;
  }
  .dropbtn {
  background-color: brown;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}


.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 100px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
</head>

<!-- Calling php function to output navigataion bar 
and it pass along the page title  -->

<?php
        include 'common.php';
        outputheader("Home");
        outputnav("Home") ;
?>

<!-- Adding a container named search-container so that the
 user can search a product and click on the search ison to search-->
 <?php
        outputSearch() 
?>
<script>
    let userSearch = document.getElementById("productSearch").value

    function searchresults(){
      
        document.getElementById("thingsFound").innerHTML=""
        document.getElementById("bodycontent").innerHTML=""
        document.getElementById("home_container").style.background = "white";
        document.getElementById("navbar").style.background = "white"
        
        userSearch = document.getElementById("productSearch").value
        let productNameTyped = document.getElementById("productSearch").value
        let productName= "searchServer.php?product="
        productName +=productNameTyped
        //console.log(productName)
        let searchResult = new XMLHttpRequest()

        searchResult.open("GET", productName)
        
        searchResult.onload = function(){
            if (searchResult.status ==200){
                console.log("Reached")
                let products = this.response
                let checkArray = products.indexOf("]")
                let theTableData= "<div id='basketDiv' hidden></div><table class='toleft'><th colspan='3'><button id ='up' class='searchbtns' onclick='searchResultsDescending()' value='ascend'>DESCENDING ORDER</button></th><th colspan='2'><button id ='down' class='searchbtns' value='descend' onclick='searchResultsAscending()'>ASCENDING ORDER<button></th>"
                if (checkArray>-1){
                    let convertArray =JSON.parse(products)
                    
                    for(i=0;i<convertArray.length;i++){
                        let ids =convertArray[i].productID
                        let idnum =ids["$oid"]
                        
                        
                        const productsfound = document.createElement("div")
                        theTableData += "<tr>"+'<td style="background-color:#E3CDC7"><img width=200 height=200 src="'+convertArray[i].image+'"></td>'+"<td>NAME: "+convertArray[i].product+"</td>"+"<td>PRICE: "+convertArray[i].price+"</td>"+"<td>Quantity: "+convertArray[i].quantity+"</td>"+"<td><button class='searchbtns' onclick='addToBasket("+'"'+idnum+'"'+","+'"'+convertArray[i].product+'"'+")'>Add to Cart</button></td>"+"</tr>"  
                        
                    }
                    theTableData += "</table>"
                    const productsfound = document.createElement("div")
                    productsfound.innerHTML = theTableData
                    document.getElementById("thingsFound").appendChild(productsfound)
                    
                }
                else{
                    document.getElementById("thingsFound").innerHTML="<div id='basketDiv' hidden></div><h1>"+ products+"</h1>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"
                }

                document.getElementById("productSearch").value = ""
                console.log(userSearch)
                
            }
            else{
                alert("Error communicating with server: " + searchResult.status);
            }
        }
        searchResult.send()
    }

    function searchResultsAscending(){
      
        console.log(userSearch)
        let orderValue =document.getElementById("up").value
        console.log(orderValue)
        document.getElementById("thingsFound").innerHTML=""
        let productName= "searchServer.php?product="
        productName +=userSearch
        productName +="&order="
        productName +=orderValue
        console.log(productName)
        let searchResult = new XMLHttpRequest()

        searchResult.open("GET", productName)
        
        searchResult.onload = function(){
            if (searchResult.status ==200){
                console.log("Reached")
                let products = this.response
                console.log(products)
                let checkArray = products.indexOf("]")
                if (checkArray>-1){
                    let convertArray =JSON.parse(products)
                    console.log(convertArray)
                    let theTableData= "<div id='basketDiv' hidden></div><table class='toleft'><th colspan='2'><button id ='up' class='searchbtns' onclick='searchResultsDescending()' value='ascend'>DESCENDING ORDER</button></th><th colspan='2'><button id ='down' class='searchbtns' value='descend' onclick='searchResultsAscending()'>ASCENDING ORDER<button></th>"
                    for(i=0;i<convertArray.length;i++){
                        let ids =convertArray[i].productID
                        let idnum =ids["$oid"]
                        theTableData += "<table class='toleft'><tr>"+'<td style="background-color:#E3CDC7"><img width=200 height=200 src="'+convertArray[i].image+'"></td>'+"<td>NAME: "+convertArray[i].product+"</td>"+"<td>PRICE: "+convertArray[i].price+"</td>"+"<td>Quantity: "+convertArray[i].quantity+"</td>"+"<td><button class='searchbtns' onclick='addToBasket("+'"'+idnum+'"'+","+'"'+convertArray[i].product+'"'+")'>Add to Cart</button></td>"+"</tr></table>"
                        
                    }
                    const productsfound = document.createElement("div")
                    productsfound.innerHTML = theTableData
                    document.getElementById("thingsFound").appendChild(productsfound)
                }
                else{
                    document.getElementById("thingsFound").innerHTML="<div id='basketDiv' hidden></div><h1>"+ products+"</h1>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"
                }
                document.getElementById("productSearch").value = ""
            }
            else{
                alert("Error communicating with server: " + searchResult.status);
            }
        }
        searchResult.send()
        
    }

    function searchResultsDescending(){
        //console.log(document.getElementById("down").value)
        let orderValue =document.getElementById("down").value
        document.getElementById("thingsFound").innerHTML=""
        let productName= "searchServer.php?product="
        productName +=userSearch
        productName +="&order="
        productName +=orderValue
        console.log(productName)
        let searchResult = new XMLHttpRequest()

        searchResult.open("GET", productName)
        
        searchResult.onload = function(){
            if (searchResult.status ==200){
                console.log("Reached")
                let products = this.response
                console.log(products)
                let checkArray = products.indexOf("]")
                if (checkArray>-1){
                    let convertArray =JSON.parse(products)
                    console.log(convertArray)
                    let theTableData= "<div id='basketDiv' hidden></div><table class='toleft'><th colspan='2'><button id ='up' class='searchbtns' onclick='searchResultsDescending()' value='ascend'>DESCENDING ORDER</button></th><th colspan='2'><button id ='down' class='searchbtns' value='descend' onclick='searchResultsAscending()'>ASCENDING ORDER<button></th>"
                    for(i=0;i<convertArray.length;i++){
                      let ids =convertArray[i].productID
                      let idnum =ids["$oid"]
                      theTableData += "<table class='toleft'><tr>"+'<td style="background-color:#E3CDC7"><img width=200 height=200 src="'+convertArray[i].image+'"></td>'+"<td>NAME: "+convertArray[i].product+"</td>"+"<td>PRICE: "+convertArray[i].price+"</td>"+"<td>Qusntity: "+convertArray[i].quantity+"</td>"+"<td><button class='searchbtns' onclick='addToBasket("+'"'+idnum+'"'+","+'"'+convertArray[i].product+'"'+")'>Add to Cart</button></td>"+"</tr></table>"   
                    }
                    const productsfound = document.createElement("div")
                    productsfound.innerHTML = theTableData
                    document.getElementById("thingsFound").appendChild(productsfound)
                }
                else{
                    document.getElementById("thingsFound").innerHTML="<div id='basketDiv' hidden></div><h1>"+ products+"</h1>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"
                }
                document.getElementById("productSearch").value = ""
            }
            else{
                alert("Error communicating with server: " + searchResult.status);
            }
        }
        searchResult.send()
        
    }

</script>

<body>

<!-- Adding a container named search content_of_page 
to display some text and a button on the screen-->
  <div id="thingsFound">
  <div class="content_of_page"> 
      <h1>Complement your <br>flawless beauty</h1>
      <p>Believe in individuality and the freedom to be whoever you want to be.</p>
      <a href="#row-1" class="button"> 2022 Collection</a>
  </div>

</div>

<!-- Display an image-->
<div id="bodycontent">
<div id="pageModel">
  <img src="/work/img/model10.png" class="model" >
</div>

<!-- Adding a container named text, to add some text and a button-->
<div class="text">
  <h1>A HIT OF OPTIMISM</h1>
  <p>Discover the latest styles from Resort 2022, a collection designed for an optimistic new now</p>
  <a href="#row-1" class="shop_button"> SHOP NOW </a>
</div>

<!-- Display all images, price and name of products on the website, with a 
div Add_Cart-2, so that when the user hovers over the Product, it displays ADD TO CART-->
  <h1 id="row-1" style="text-align: center;">LATEST T-SHIRTS</h1><br>
  <div class="row-1">

    <div class="column-1">
      <img src="/work/img/product5.jpg">
      <div class="over_image_text">
        <div class="Add_Cart-2">Add to Cart</div>
      </div>
      <h5>New York Tee</h5>
      <p>Rs.550</p>        
    </div>

    <div class="column-1">
      <img src="/work/img/product4.jpg">
      <div class="over_image_text">
        <div class="Add_Cart-2">Add to Cart</div>
      </div>
      <h5>Sun and Moon Tee</h5>
      <p>Rs.400</p>        
    </div>

    <div class="column-1">
      <img src="/work/img/product16.jpg">
      <div class="over_image_text">
        <div class="Add_Cart-2">Add to Cart</div>
      </div>
      <h5>Teddy Bear Tee</h5>
      <p>Rs.300</p>        
    </div>

  </div>

<!-- Display all images, price and name of products on the website, with a 
div Add_Cart-2, so that when the user hovers over the Product, it displays ADD TO CART-->

<h1 id="text2" style="text-align: center;">ALL PRODUCTS</h1>


<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Sort Methods</button>
  <div id="myDropdown" class="dropdown-content">
    <div><button onclick="ascending()" class="searchbtns">Ascending</button></div>
    <div><button onclick="descending()" class="searchbtns">Descending</button></div>
  </div>
</div>
</br>
</br>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Sort Methods</button>
  <div id="myDropdown" class="dropdown-content">
    <div><button onclick="ascending()" class="searchbtns">Ascending</button></div>
    <div><button onclick="descending()" class="searchbtns">Descending</button></div>
  </div>
</div>
</br>
</br>
<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<div class="row-2" id="displayProducts">

<?php
        require __DIR__ . '/vendor/autoload.php';
        $mongoClient = (new MongoDB\Client);
        $db = $mongoClient->ecommerce;
        //Find all products
        $products = $db->Product->find();
        foreach ($products as $document) {
            echo '<div class="column-2">';
            echo '<img src='.$document["Image_URL"].'>';
            echo '<div class="over_image_text">';
            echo '  <div><button class="Add_Cart" onclick=\'addToBasket("' . $document["_id"] . '", "' . $document["Product_Name"] . '", ' . $document["Price"] . ')\' >Add to Cart</button></div>';
            echo '</div>';
            echo '<h5>' . $document["Product_Name"] . "</h5>";
            echo '<p>Rs.' . $document["Price"] . "</p>";
            echo '</div>';
            
        }
        
        
?>
<div id="basketDiv" hidden></div>
</div>
</div>

<!-- php function that outputs the footer-->


</body>



<?php
  outputfooter() 
?>
</html>


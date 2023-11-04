<!-- Calling php function to output navigataion bar 
and it pass along the page title  -->

<?php
session_start();
        include 'common.php';
        outputheader("Profile");
        outputnav("Profile") ;
?>

<?php
//Include libraries


require __DIR__ . '/vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->ecommerce;

$collection = $db->Orders;
$mail=$_SESSION['loggedInUserEmail'];

//Create a PHP array with our search criteria
$findCriteria = [
    "Customer_Email" => $mail,
];

$result = $collection->find($findCriteria);

// echo json_encode(iterator_to_array($result));
?>
<link rel="stylesheet" href="/work/codes/css/profile.css">
<h1 style="text-align: center;">My Orders</h1>
            
  <table class="center">
    <thead>
      <tr>
      <th>Order ID</th>
      <th>Quantity</th>
      <th>Product Bought</th>
      <th>Total</th>
      <th>Customer Email</th>
      <th>Purchase Date</th>    
      
      </tr>
    </thead>
    <tbody>
    <?php 
        if($result){
            foreach($result as $results){ ?>

      <tr>
        <td><?=  $results['_id'] ?></td>
        <td><?=  $results['Quantity'] ?></td>
        <td><?=  $results['Product_Bought'] ?></td>
        <td><?=  $results['Total'] ?></td>
        <td><?=  $results['Customer_Email'] ?></td>
        <td><?=  $results['Purchase_Date'] ?></td>
        

      </tr>
        
      <?php }
        } ?>
    </tbody>
  </table>

  <div id="customers">
    <button onclick="display_table()" >edit my info</button>
  </div>
  </html>

  
  <script>



  function display_table(json_data) {
      //Convert JSON to array of product objects
      let obj = JSON.parse(json_data);
      for(let i=0; i<obj.length; ++i){
        

      //Create HTML table containing product data

      htmlStr += '<div class="form">';

      htmlStr += '<form>'

      
      htmlStr += '<label for="FirstName">First Name</label>';
      htmlStr += '<input type="text" value='+obj[i].FirstName+' id="FirstName" placeholder="new First Name">';
    
      htmlStr += '<label for="LastName">Last Name</label>'
      htmlStr += '<input type="text" value='+obj[i].LastName+' id="LastName" placeholder="new Last Name">'

      htmlStr += '<label for="Email">Email Address</label>'
      htmlStr += '<input type="email" value='+obj[i].Email+' id="Email" placeholder="new Email address ">'
  
      htmlStr += '<label for="Street">Street</label>'
      htmlStr += '<input type="text" value='+obj[i].Street+' id="Street" placeholder="new Street">'

      htmlStr += '<label for="City">City </label>'
      htmlStr += '<input type="text" value='+obj[i].City+' id="City" placeholder="new City here">'

      htmlStr += '<label for="Country">Country</label>';
      htmlStr += '<input type="text" value='+obj[i].Country+' id="Country" placeholder="new Country ">';
      
      htmlStr += '<label for="ZIPcode">ZIP code</label>'
      htmlStr += '<input type="number" value='+obj[i].ZIPcode+' id="ZIPcode" placeholder="new ZIP code ">'

      htmlStr += '<label for="PhoneNo">Phone No</label>'
      htmlStr += '<input type="tel" value='+obj[i].PhoneNo+' id="PhoneNo" placeholder="new Phone No">'
  
      htmlStr += '<label for="Password">Password</label>'
      htmlStr += '<input type="password" value='+obj[i].Password+' id="Password" placeholder="new Password">'

      htmlStr += '<button onclick="performupdate()" type="button" class="btn btn-light">Save changes</button>'

      htmlStr += '</form>'
      htmlStr += "</div>";

      htmlStr +='<div id=ServerResponse></div>'

      document.getElementById("customers").innerHTML = htmlStr;
      }
  }

      function performupdate(){
          

              //Create request object 
              let request = new XMLHttpRequest();

              //Create event handler that specifies what should happen when server responds
              request.onload = () => {
                  //Check HTTP status code
                  if (request.status === 200) {
                      //Get data from server
                      let responseData = request.responseText;

                      //Add data to page
                      document.getElementById("ServerResponse").innerHTML = responseData;
                  }
                  else
                      alert("Error communicating with server: " + request.status);
              };

              //Set up request with HTTP method and URL 
              request.open("POST", "update.php");
              request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

              //Extract registration data
              let FirstName = document.getElementById("FirstName").value;
              let LastName = document.getElementById("LastName").value;
              let Email = document.getElementById("Email").value;
              let Street = document.getElementById("Street").value;
              let City = document.getElementById("City").value;
              let Country = document.getElementById("Country").value;
              let ZIPcode = document.getElementById("ZIPcode").value;
              let PhoneNo = document.getElementById("PhoneNo").value;
              let Password = document.getElementById("Password").value;



              //Send request
              request.send("FirstName=" + FirstName + "&LastName=" + LastName + "&Email=" + Email + "&Street=" + Street + "&City=" + City + "&Country=" + Country + "&ZIPcode=" + ZIPcode + "&PhoneNo=" + PhoneNo + "&Password=" + Password);
          }